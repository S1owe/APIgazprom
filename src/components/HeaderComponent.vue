<template>
    <div id="header">
        <div class="logo_container">
            <div class="logo_item_title">Газпромбанк</div>
            <div class="logo_item_line"></div>
            <div class="logo_item_secondTitle">для разработчиков</div>
        </div>

        <div class="menu">
            <div class="menu_item">Продукты API</div>
            <div class="menu_item">Наши преимущества</div>
            <div class="menu_item">Помощь разработчику</div>
        </div>

        <div class="input" v-if="is_auth === false">
            <div class="input_btn">Войти</div>
            <div class="input_btn-registration">
                <div class="input_btn-registration-background"></div>
                <div class="text">Зарегистрироваться</div>
            </div>
        </div>

        <div class="input aut" v-if="is_auth === true">
            <div class="input_btn">{{username}}</div>
           <div class="input_svg" @click="logout">
               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M11.9395 12H21.6895" stroke="#262C40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                   <path d="M17.9473 18.75V21H5.94727V3H17.9473V5.25H19.4473V2.25C19.4473 2.05109 19.3682 1.86032 19.2276 1.71967C19.0869 1.57902 18.8962 1.5 18.6973 1.5H5.19727C4.99835 1.5 4.80759 1.57902 4.66694 1.71967C4.52628 1.86032 4.44727 2.05109 4.44727 2.25V21.75C4.44727 21.9489 4.52628 22.1397 4.66694 22.2803C4.80759 22.421 4.99835 22.5 5.19727 22.5H18.6973C18.8962 22.5 19.0869 22.421 19.2276 22.2803C19.3682 22.1397 19.4473 21.9489 19.4473 21.75V18.75H17.9473Z" fill="#262C40"/>
                   <path d="M21.6895 12L18.6895 15" stroke="#262C40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                   <path d="M21.6895 12L18.6895 9" stroke="#262C40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                   <path d="M18.6895 6.0675V4.5675" stroke="#262C40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                   <path d="M18.6895 19.5V18" stroke="#262C40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>

           </div>
        </div>
    </div>
</template>

<script>
    import {store_vars} from "@/mixins";
    import {send} from "@/const";

    export default {
        name: "HeaderComponent",
        mixins: [store_vars],

        beforeCreate() {

        },

        created() {

        },

        mounted() {

        },

        watch: {

        },

        methods: {
          logout: function () {
            send.get('api.php', {
              params: {
                type: 'logout'
              }
            }).then(() => {
              this.username = '';
              this.is_auth = false;
              this.token = '';
              this.$router.push({name: 'auth'});
            });
          }
        },

        components: {

        }
    }
</script>

<style lang="scss" scoped>
    @import "../styles_fonts";

    $blue: #0066CC;
    $dark: #262C40;

    $font_ProximaNova-Regular: ProximaNova-Regular, 'ProximaNova-Regular';

    #header {
        z-index: 100;
        position: fixed;
        width: calc(100%);
        height: 110px;
        background-color: white;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 0 240px;
        align-items: center;
        box-shadow:0px 2px 7px 2px rgba(0,0,0,0.11);
        -webkit-box-shadow:0px 2px 7px 2px rgba(0,0,0,0.11);
        -moz-box-shadow:0px 2px 7px 2px rgba(0,0,0,0.11);
        font-size: 18px;
        color: #262C40;
    }

    .logo_container {
        font-family: $font_ProximaNova-Regular;
        color: $dark;
        display: flex;
        flex-direction: row;
        align-items: center;
        cursor: pointer;
      //  margin-right: 92px;

        .logo_item_title {
            font-weight: bold;
        }

        .logo_item_line {
            width: 3px;
            height: 32px;
            background: #262C40;
            margin: 0 10px 0 10px;
        }

        .logo_item_secondTitle {

        }
    }

    .menu {
        display: flex;
        flex-direction: row;
        font-family: $font_ProximaNova-Regular;
        align-items: center;

        .menu_item {
            margin: 0 24px;
        }

        .menu_item:hover {
           cursor: pointer;
            text-decoration: underline;
        }
    }

    .input {
        font-family: $font_ProximaNova-Regular;
        display: flex;
        align-items: center;
        flex-direction: row;

        .input_btn {
            color: #262C40;
            cursor: pointer;
            margin-right: 40px;
        }

        .input_btn:hover {
            text-decoration: underline;
        }

        .input_btn-registration {
            cursor: pointer;
            width: 220px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid $blue;
            color: $blue;
            position: relative;
            overflow: hidden;

            .text {
                z-index: 5;
                transition: 0.7s ease-in-out;
            }
        }

        .input_btn-registration:hover {
            cursor: pointer;
          //  color: white;

            .text {
                color: white;
            }

            .input_btn-registration-background {
                left: 0;
                z-index: 1;
                background-color: $blue;
                transform: scale(2);
            }
        }

        .input_btn-registration-background {
            transition: 0.7s ease-in-out;
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            left: -300px;
            bottom: calc(50%);
            z-index: 1;
            background-color: $blue;
            transform: scale(1);
        }
    }

    .aut {
        .input_btn {
            color: #262C40;
            cursor: pointer;
            margin-right: 10px;
        }

        .input_svg {
            margin-top: -6px;
            cursor: pointer;
            transition: 0.5s ease;
        }

    }




</style>
