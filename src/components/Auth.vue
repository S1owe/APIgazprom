<template>
  <div class="auth-page">
    <div class="auth-page__main">
      <div class="auth-page__logo">
        <logo view-type="primary" />
      </div>

      <div class="auth-page__content">
        <div class="auth-page__tabs">
          <button
            class="auth-page__loginBtn"
            :class="loginBtnClasses"
            @click="activeTab = 'login'"
          >
            Вход
          </button>

          <button
            class="auth-page__registerBtn"
            :class="regBtnClasses"
            @click="activeTab = 'register'"
          >
            Регистрация
          </button>
        </div>

        <div v-if="isLogin" class="auth-page__loginTab">
          <div class="auth-page__inputWrap">
            <base-input
              v-model="login.email"
              type="email"
              placeholder="Электронная почта"
            />
          </div>

          <div class="auth-page__inputWrap">
            <base-input
              v-model="login.password"
              type="password"
              placeholder="Пароль"
            />
          </div>

          <div class="auth-page__actions">
            <base-checkbox
              v-model="login.rememberMe"
              label="Запомнить меня"
            ></base-checkbox>

            <base-button theme="plain" size="small">Забыли пароль?</base-button>
          </div>

          <div class="auth-page__submitWrapper">
            <base-button @click="handleSubmitLogin" theme="default" size="big">
              Вход
            </base-button>
          </div>

          <div class="auth-page__support">
            <base-button theme="plain" size="small" :underline="true">
              Не можете войти в систему?
            </base-button>

            <span class="auth-page__support-text">
              Обратитесь в службу поддержки!
            </span>
          </div>
        </div>

        <div v-if="isRegister" class="auth-page__registerTab">
          <div class="auth-page__inputWrap">
            <base-input
              v-model="register.fullName"
              type="text"
              placeholder="Полное имя"
            />
          </div>

          <div class="auth-page__inputWrap">
            <base-input
              v-model="register.email"
              type="email"
              placeholder="Электронная почта"
            />
          </div>

          <div class="auth-page__inputWrap">
            <base-input
              v-model="register.password"
              type="password"
              placeholder="Пароль"
            />
          </div>

          <div class="auth-page__inputWrap">
            <base-input
              v-model="register.passwordConfirm"
              type="password"
              placeholder="Подтверждение пароля"
            />
          </div>

          <div class="auth-page__submitWrapper">
            <base-button
              @click="handleSubmitRegister"
              theme="default"
              size="big"
            >
              Регистрация
            </base-button>
          </div>

          <div class="auth-page__support">
            <span class="auth-page__support-text">
              Регистрируясь вы принимаете
            </span>

            <base-button theme="plain" size="small" :underline="true">
              Условия использования Газпромбанк
            </base-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseButton from '@/components/elements/BaseButton';
import BaseInput from '@/components/elements/inputs/BaseInput';
import BaseCheckbox from '@/components/elements/inputs/BaseCheckbox';
import Logo from '@/components/elements/Logo';
import {notify, send} from "@/const";
import {store_vars} from "@/mixins";

export default {
  name: "AuthPage",
  mixins: [store_vars],

  components: { BaseButton, BaseInput, BaseCheckbox, Logo },

  data() {
    return {
      activeTab: "login",
      login: {
        email: "",
        password: "",
        rememberMe: false,
      },
      register: {
        fullName: "",
        email: "",
        password: "",
        passwordConfirm: "",
      },
    };
  },

  computed: {
    isLogin() {
      return this.activeTab === "login";
    },
    isRegister() {
      return this.activeTab === "register";
    },
    loginBtnClasses() {
      const prefix = "auth-page__loginBtn";

      return {
        [`${prefix}--active`]: this.isLogin,
      };
    },
    regBtnClasses() {
      const prefix = "auth-page__registerBtn";

      return {
        [`${prefix}--active`]: this.isRegister,
      };
    },
  },

  methods: {
    handleSubmitLogin() {
      // console.log(this.login);
      send.get('api.php', {
        params: {
          type: 'signIn',
          login: this.login.email,
          password: this.login.password
        }
      }).then((response) => {
        if (response.result !== '0')
          notify(response.notify_msg, 'error');
        else {
          this.username = response.username;
          this.is_auth = true;
          this.token = response.token;
          this.$router.push('/');
        }
      });
    },
    handleSubmitRegister() {
      console.log(this.register);
      send.get('api.php', {
        params: {
          type: 'signUp',
          email: this.register.email,
          password: this.register.password,
          full_name: this.register.fullName
        }
      }).then((response) => {
        if (response.code !== '0')
          notify(response.notify_msg, 'error');
        else {
          this.username = this.register.fullName;
          this.is_auth = true;
          this.token = response.token;
          this.$router.push('/');
        }
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../assets/scss/index";

.auth-page {
  width: 100%;
  height: 100%;
  position: relative;
  background-color: #e5e5e5;
  padding-top: 158px;
  box-sizing: border-box;
  display: flex;
  justify-content: center;

  &__logo {
    margin-bottom: 47px;
  }

  &__content {
    width: 500px;
  }

  &__tabs {
    display: flex;
  }

  &__loginBtn,
  &__registerBtn {
    width: 50%;
    padding-top: 28px;
    padding-bottom: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
    outline: none;
    border: none;
    background-color: #e5e5e5;
    color: $color-blue--light;
    font-size: $font-size-big;
    font-weight: $font-weight-medium-x;

    &--active {
      background-color: $color-white;
      color: $color-blue;
    }
  }

  &__inputWrap {
    margin-bottom: 20px;
  }

  &__actions {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
  }

  &__submitWrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  &__support {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &__support-text {
    font-size: $font-size-base;
  }

  &__loginTab,
  &__registerTab {
    width: 100%;
    padding: 64px 48px 57px 48px;
    box-sizing: border-box;
    background-color: $color-white;
  }
}
</style>
