import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    is_auth: false,
    token: '',
    username: ''
  },
  getters: {
    username(state) {
      return state.username;
    },
    is_auth(state) {
      return state.is_auth;
    },
    token(state) {
      return state.token;
    }
  },
  mutations: {
    username(state, username) {
      state.username = username;
    },
    is_auth(state, is_auth) {
      state.is_auth = is_auth;
    },
    token(state, token) {
      state.token = token;
    },
  },
});
