<template>
  <div id="content_doc_api">
    <div v-html="content_start"></div>

    <div class="sandbox w-100 row m-0" v-if="sandbox">
      <div class="col-2 d-flex flex-column align-items-start query pb-4">
        <template v-for="(val, param) in sandbox.params">
          <span class="mt-3" :key="'s_' + param">{{param}}</span>
          <input type="text" v-if="val.type === 'text'" :key="'i_' + param" class="form-control" v-model="val.value" />
          <b-check v-else :key="'i_' + param" v-model="val.value" >Bool: {{val.value ? 'True' : 'False'}}</b-check>
        </template>
        <button class="btn mt-3 w-100" @click="sandbox_query">
          <span>Выполнить</span>
        </button>
      </div>
      <div class="col-10 response pl-4 pt-4 pr-4">
        <transition name="global" mode="out-in" appear>
          <Loading v-if="!is_sandbox_response" />
          <pre v-else>{{sandbox_response}}</pre>
        </transition>
      </div>
    </div>

    <div v-html="content_end"></div>
  </div>
</template>

<script>

import {send} from "@/const";
import Loading from "@/components/Loading";
export default {
  name: "DocContent",
  components: {Loading},
  props: ['content_start', 'sandbox', 'content_end'],
  data: function () {
    return {
      sandbox_response: "",
      is_sandbox_response: false
    }
  },
  methods: {
    sandbox_query: function () {
      let send_params = {};
      for (let i in this.sandbox.params)
        send_params[i] = this.sandbox.params[i].value;
      this.is_sandbox_response = false;

      send.get('api.php', {
        params: {
          type: 'sandbox',
          payload: send_params
        }
      }).then((response) => {
        this.sandbox_response = response;
        this.is_sandbox_response = true;
      });
    }
  },
  created() {
    if (this.sandbox)
      this.sandbox_query();
  }
}
</script>

<style lang="scss" scoped>
.sandbox {
  .query {
    background-color: #D7DEE9;

    button {
      background-color: #0066CC;
      span {
        color: white;
      }
    }
  }

  .response {
    background-color: #F0F1F4;

    pre {
      white-space: pre-wrap;
      word-wrap: break-word;
    }
  }
}
</style>

<style lang="scss">
#api_doc #content_doc_api {

  h1, h2, h3, h4, h5, h6 {
    font-family: "ProximaNova-Bold";
    margin-top: 40px;
    margin-bottom: 14px;
  }

  h1 {
    font-size: 48px;
  }

  h2 {
    font-size: 32px;
  }

  h3 {
    font-size: 24px;
  }

  table {
    border-collapse: collapse;

    thead {
      background-color: #D7DEE9;
    }

    td, th {
      padding: 8px 52px;
    }

    td {
      border-bottom: 1px #D7DEE9 solid;
    }
  }
}
</style>
