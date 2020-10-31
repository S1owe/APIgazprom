<template>
  <Loading v-if="!is_show" />
  <div v-else class="row m-0" id="api_doc">
    <div class="col-3 sidebar d-flex flex-column p-0">
      <div class="d-flex align-items-center justify-content-between m-4">
        <b class="title">Газпром ID Authorization API</b>
        <b-select :options="versions" v-model="select_version" class="w-auto"
                  @change="$router.push({name: 'api_doc', params: {version: select_version, module: module}})"/>
      </div>
      <div class="hr w-100"></div>
      <DocPunct v-for="point in points" :key="point.href" :point="point" :active_module="module"
                @click="change_api(point.href)"/>
    </div>
    <div class="col-9 p-4 content" @scroll="scroll">
      <transition name="global" mode="out-in" appear>
        <Loading v-if="!content_doc.is_show"/>
        <DocContent v-else :key="module"
                    :content_start="content_doc.start"
                    :sandbox="content_doc.sandbox"
                    :content_end="content_doc.end"/>
      </transition>
    </div>
  </div>
</template>

<script>
import DocPunct from "@/components/doc/DocPunct";
import DocContent from "@/components/doc/DocContent";

import {notify, send} from "@/const";
import Loading from "@/components/Loading";

export default {
  name: "ApiDoc",
  components: {Loading, DocContent, DocPunct},
  props: ['version', 'module'],
  data: function () {
    return {
      is_show: false,

      versions: [{value: '5.6.11', text: '5.6.11'}],
      select_version: this.version,
      points: /*[
        {
          text: 'Памятка по интеграции',
          href: 'get_integrate',
          is_parse_header: true,
          headers: [],
          is_sandbox: false
        },
        {
          text: 'Обзор API',
          href: 'review',
          is_parse_header: true,
          headers: [],
          is_sandbox: true,
          sandbox: {
            params: {
              token: {
                type: 'text',
                value: 'test1'
              },
              device_model: {
                type: 'text',
                value: 'test2'
              },
              device_year: {
                type: 'text',
                value: 'test3'
              },
              sandbox: {
                type: 'text',
                value: 'test4'
              },
              test_bool: {
                type: 'bool',
                value: true
              }
            }
          }
        },
        {
          text: 'Приступая к работе',
          href: 'get_start',
          is_parse_header: true,
          headers: [],
          is_sandbox: false
        },
        {
          text: 'Интеграция для партнеров',
          href: 'partners',
          is_parse_header: true,
          headers: [],
          is_sandbox: false
        },
        {
          text: 'Прямая интеграция для Холдингов (Получение и отправка документов по организациям и компаниям группы)',
          href: 'holdings',
          is_parse_header: true,
          headers: [],
          is_sandbox: false
        },
        {
          text: 'Авторизация пользователя ',
          href: 'user_auth',
          is_parse_header: false,
          headers: [],
          is_sandbox: false
        }
      ]*/[],

      content_doc: {
        start: '',
        sandbox: [],
        end: '',
        is_show: false
      },
      scroll_position: 0
    }
  },
  methods: {
    scroll: function (event) {
      let scroll_top = {};
      if (event)
        scroll_top = event.target.scrollTop;
      else
        scroll_top = document.getElementsByClassName('content')[0].scrollTop;
      let flag = false, after = null;
      if (Math.abs(scroll_top - this.scroll_position) < 10 && this.scroll_position !== 0)
        return;
      let point = this.points.find(p => p.href === this.module);
      if (!point.is_parse_header)
        return;
      this.scroll_position = scroll_top;
      point.headers
        .forEach((h) => {
          let offset_h = document.querySelector("#api_doc #content_doc_api a[name=" + h.value + "]").offsetTop;
          if (offset_h > scroll_top && !flag) {
            h.is_active = true;
            flag = true;
            if (this.$route.hash !== '#' + h.value)
              this.$router.push('#' + h.value);
          } else {
            h.is_active = false;
          }
          after = h;
        });
      if (!flag && after !== null) {
        after.is_active = true;
        if (this.$route.hash !== '#' + after.value)
          this.$router.push('#' + after.value);
      }
    },
    render_api: function (module = this.module) {
      this.content_doc.is_show = false;
      send
        .get("/doc_md/" + this.select_version + "/" + module + ".md")
        .then((response) => {
          let MarkdownIt = require('markdown-it'),
            md = new MarkdownIt();
          this.content_doc.start = md.render(response);
          let point = this.points.find(p => p.href === module);
          if (point.is_parse_header) {
            point.headers.length = 0;
            this.content_doc.start = this.content_doc.start.replace(/(<h[0-9]>)(.*?)(<\/h[0-9]>)/g, function (text, tg_in, content, tg_out) {
              let name = content.replaceAll(' ', '-');
              point.headers.push({text: content, value: name, is_active: point.headers.length === 0});
              return tg_in + "<a name='" + name + "'>" + content + "</a>" + tg_out;
            });
          }
          if (point.is_sandbox) {
            let match = this.content_doc.start.split("<p>&lt;:::sandbox:::&gt;</p>");
            this.content_doc.start = match[0];
            this.content_doc.end = typeof match[1] !== 'undefined' ? match[1] : '';
            this.content_doc.sandbox = point.sandbox;
          } else
            this.content_doc.sandbox = false;
          this.content_doc.is_show = true;
        })
        .catch(() => {
          notify("Файл документации не найден!", 'error');
        });
    },
    change_api: function (module) {
      if (this.module !== module) {
        this.render_api(module);
        setTimeout(() => {
          this.$router.push({name: 'api_doc', params: {version: this.select_version, module: module}});
          this.scroll_position = 0;
          setTimeout(() => {
            this.$nextTick(() => {
              this.scroll();
            });
          }, 300);
        }, 200);
      }
    }
  },
  created() {
    send.get("api.php", {
      params: {
        type: "getDocumentation",
        id_api: 1
      }
    }).then((response) => {
      this.points = response.points;
      if (this.versions.findIndex(v => v.value === this.version) === -1) {
        notify("Версия не найдена", 'error');
        this.$router.push({name: 'main'});
      }
      if (typeof this.module !== 'undefined' && this.points.findIndex((p => p.href === this.module)) === -1) {
        notify("Модуль API не найден", 'error');
        this.$router.push({
          name: 'api_doc',
          params: {
            version: this.version
          }
        });
      }
      this.is_show = true;
      if (this.module) {
        this.$nextTick(() => {
          this.render_api();
        });
      } else {
        this.content_doc.start = "<h1>Выберите ппункт</h1>";
        this.content_doc.end = '';
        this.content_doc.sandbox = false;
        this.content_doc.is_show = true;
      }
    });
  }
}
</script>

<style lang="scss">
@import "@/styles_fonts.scss";

#api_doc {
  p, h1, h2, h3, h4, h5, span, td, th {
    font-family: 'ProximaNova-Regular';
    font-size: 18px;
  }

  b {
    font-family: 'ProximaNova-Bold';
    font-weight: 700;
    font-size: 18px;
  }
}
</style>

<style scoped>
.sidebar {
  border-right: 2px solid #D7DEE9;
  height: calc(100vh - 110px);
  overflow-y: auto;
  overflow-x: hidden;
}

.content {
  height: calc(100vh - 110px);
  overflow-y: auto;
}

select {
  cursor: pointer;
  border: 0;
  font-size: 18px;
}
</style>
