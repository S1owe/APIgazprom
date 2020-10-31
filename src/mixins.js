export const store_vars = {
  computed: {
    username: {
      get() {
        return this.$store.state.username
      },
      set(value) {
        this.$store.commit('username', value);
      }
    },
    token: {
      get() {
        if (process.env.NODE_ENV !== 'production' && this.$store.state.token === '' && localStorage.getItem('token') !== null)
          this.$store.commit('token', localStorage.getItem('token'));
        return this.$store.state.token
      },
      set(value) {
        if (process.env.NODE_ENV !== 'production')
          localStorage.setItem('token', value);
        this.$store.commit('token', value);
      }
    },
    is_auth: {
      get() {
        return this.$store.state.is_auth
      },
      set(value) {
        this.$store.commit('is_auth', value);
      }
    },
  }
};
