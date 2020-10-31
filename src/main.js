import Vue from 'vue'
import App from './App.vue'
import router from './Router.js';
import store from './store/store';
import BootstrapVue from 'bootstrap-vue'
import '@/fa.config.js'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);

import './assets/icons/globalComponents';

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
