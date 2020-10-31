<template>
  <transition name="global" mode="out-in" appear>
    <Loading v-if="!is_open" :times="300" />
    <div id="app" class="app" v-else>
      <HeaderComponent v-if="!isAuthPage"/>
      <transition name="global" mode="out-in" appear>
        <div class="row m-0 component" v-if="$route.meta[0] === 'lk'">
          <LeftSidebar/>
          <div class="col-9">
            <transition name="global" mode="out-in" appear>
              <router-view class="component" :key="$route.path"/>
            </transition>
          </div>
        </div>

        <router-view v-else class="component"
                     :key="$route.name === 'api_doc' ? $route.name + this.$route.params.version : $route.path"/>
      </transition>
      <FooterComponent v-if="!isAuthPage && $route.name !== 'api_doc'"/>
    </div>
  </transition>
</template>

<script>
import {send, defaultParams, notify, log} from "@/const.js"
import HeaderComponent from "@/components/HeaderComponent";
import FooterComponent from '@/components/FooterComponent'
import {store_vars} from "@/mixins";
import LeftSidebar from "@/components/blocks/LeftSidebar";
import Loading from "@/components/Loading";

send.interceptors.response.use(function (response) {
  // Обработка Then
  if (response.data.error_auth && process.env.NODE_ENV === 'production')
    location = defaultParams.path + "auth/";
  return response.data;
}, function (error) {
  // Обработка Catch
  if (error.response) {
    if (error.response.status === 501 && error.response.data.error)
      notify(error.response.data.error, 'error');
    else
      notify("Ошибка", "error");
    log(error.response);
    // alert("Код ошибки: " + error.response.status + "\n" + error.response.data);
    // console.log(error.response);
  } else {
    notify(error.message, 'error');
  }
  // router.push({name: 'main'});
  return Promise.reject(error);
});

export default {
  name: 'app',
  components: {Loading, LeftSidebar, HeaderComponent, FooterComponent},
  mixins: [store_vars],
  data() {
    return {
      is_open: false
    }
  },
  created() {
    send.interceptors.request.use((config, em = this) => {
      if (process.env.NODE_ENV !== 'production') {
        if (config.params)
          config.params['token'] = em.token;
        else
          config.params = {
            token: em.token
          };
      }
      return config;
    }, function (error) {
      return Promise.reject(error);
    });

    send.get('api.php', {
      params: {
        type: 'checkAuth'
      }
    }).then((response) => {
      if (response.code !== '0') {
        if (!this.isAuthPage && this.$route.name !== 'main' && this.$route.name !== 'products') {
          this.$router.push({name: 'auth'});
        }
      } else {
        this.username = response.username;
        this.is_auth = true;
        if (this.isAuthPage)
          this.$router.push("/");
      }
      this.$nextTick(() => {
        this.is_open = true;
      });
    });
  },
  computed: {
    isAuthPage() {
      return this.$route.name === 'auth';
    }
  }
}
</script>

<style lang="scss">
@import '~@/../node_modules/noty/lib/noty.css';
@import "~@/../node_modules/noty/lib/themes/metroui.css";

.custom_modal {

  .modal-header {
    border-bottom: 2px #F0F1F4 solid;
  }

  .modal-footer {
    border-top: 2px #F0F1F4 solid;

    button {
      font-family: "ProximaNova-Bold";
      width: 10rem;
    }

    .ok, .ok:hover {
      color: white;
      background-color: #0066CC;
    }

    .cancel, .cancel:hover {
      color: #0066CC;
      border: 2px #0066CC solid;
    }
  }
}

html {
  min-width: 1617px;
}

body {
  margin: 0;
  padding: 0;
}

button, a {
  outline: none;
}

.app a:hover {
  text-decoration: none;
}

.component {
  padding-top: 110px;
  margin-bottom: 50px;
}

.component .component {
  padding-top: 0;
}

.collapse-btn .icon svg {
  transition: transform 0.3s ease;
}

.hr {
  width: 100%;
  height: 0;
  border-bottom: 2px solid #D7DEE9;
}

.not-collapsed .icon svg {
  transform: rotate(90deg);
}

.radius-right-none {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  border-right: none;
}

.radius-left-none {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.radius-bottom-none {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.radius-top-none {
  border-top-left-radius: 0 !important;
  border-top-right-radius: 0 !important;
}

/*Animate Groups*/
.items {
  position: relative;
}

.list-item {
  transition: all 1s;
  display: inline-block;
  width: 100%;
  /*margin-right: 10px;*/
}

.list-enter, .list-leave-to
  /* .list-complete-leave-active до версии 2.1.8 */
{
  opacity: 0;
  transform: translateY(30px);
}

.list-leave-to.list-right, .list-enter.list-right {
  transform: translateX(30px);
}

.list-leave-active {
  /*position: absolute !important;*/
  left: 0;
  right: 0;
  z-index: 9999;
}

/*End*/

/*Transition*/
.global-enter-active, .global-leave-active {
  transition: opacity .3s ease;
}

.global-enter, .global-leave-to
  /* .component-fade-leave-active до версии 2.1.8 */
{
  opacity: 0;
}

.animated {
  animation-duration: 0.3s;
}

/*End*/

span, h1, h2, h3, h4, h5, h6, th, td {
  color: #262C40;
}

select, .btn {
  box-shadow: none !important;
}
</style>
