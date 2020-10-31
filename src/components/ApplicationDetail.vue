<template>
  <div class="application-detail">
    <div class="application-detail__container">
      <div class="application-detail__header">
        <div class="application-detail__main">
          <h2 class="application-detail__title">{{ title }}</h2>

          <button class="application-detail__removeBtn">
            Удалить приложение
          </button>
        </div>

        <div class="application-detail__team-info">
          <div class="application-detail__owner">
            <span class="application-detail__owner-label">Владелец:</span>
            <span class="application-detail__owner-name">{{ owner }}</span>
          </div>

          <div class="application-detail__team">
            <span class="application-detail__team-label">Команда:</span>
            <span class="application-detail__team-name">{{ team }}</span>
          </div>
        </div>
      </div>

      <div class="application-detail__content">
        <h3 class="application-detail__subTitle">Ключи API:</h3>

        <div class="application-detail__cards">
          <api-key-card
            v-for="(index, i) in apiCards"
            :key="i"
            :title="index.title"
            :description="index.description"
            :api-key="index.apiKey"
          />
        </div>
      </div>

      <div class="application-detail__content">
        <h3 class="application-detail__subTitle">Библиотека API:</h3>

        <div class="application-detail__cards">
          <div
            class="application-detail__card-item"
            v-for="(item, i) in apiLibs"
            :key="i"
          >
            <product-card
              :title="item.title"
              :description="item.description"
              :viewType="item.viewType"
              :status="item.status"
              @handle-sub="(sub) => handleSub(sub, i)"
              linkText="Документация"
            >
              <svg
                width="44"
                height="34"
                viewBox="0 0 44 34"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M3.63636 0H40.3636C42.3719 0 44 1.79086 44 4V28C44 30.2091 42.3719 32 40.3636 32H20V28H40V14H4V18H0V4C0 1.79086 1.62806 0 3.63636 0ZM40 4V10H4V4H40ZM0 28.0001H9.17157L6.58579 30.5859L9.41421 33.4143L16.8284 26.0001L9.41421 18.5859L6.58579 21.4143L9.17157 24.0001H0V28.0001Z"
                  fill="#262C40"
                />
              </svg>
            </product-card>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ApiKeyCard from "./cards/ApiKeyCard";
import ProductCard from "./cards/ProductCard";

export default {
  name: "ApplicationDetail",

  components: { ApiKeyCard, ProductCard },

  props: {},

  data() {
    return {
      title: "Мое приложение 1",
      owner: "Зиновьев Ярослав",
      team: "API для банкоматов",

      apiCards: [
        {
          title: "ID приложения",
          description:
            "Идентификатор приложения используется для идентификации вашего набора продуктов API.",
          apiKey: "4491123c-e455-203d-t0ad-5e8-2f6e5-f4h02",
        },
        {
          title: "Ключ клиента",
          description:
            "Ключ клиента высылается на эл. почту при регистрации учетной записи.",
          apiKey: "4491123c-e455-203d-t0ad-5e8-2f6e5-f4h02",
        },
      ],

      apiLibs: [
        {
          title: "Корпоративная выплата",
          description:
            "Информация о счете(ах) и транзакции(ах): список счетов, реквизиты счета, реквизиты транзакции и история.",
          viewType: "sub",
          status: "",
        },
        {
          title: "Корпоративная выплата",
          description:
            "Информация о счете(ах) и транзакции(ах): список счетов, реквизиты счета, реквизиты транзакции и история.",
          viewType: "unsub",
          status: "",
        },
        {
          title: "Корпоративная выплата",
          description:
            "Информация о счете(ах) и транзакции(ах): список счетов, реквизиты счета, реквизиты транзакции и история.",
          viewType: "sub",
          status: "Премиум",
        },
        {
          title: "Корпоративная выплата",
          description:
            "Информация о счете(ах) и транзакции(ах): список счетов, реквизиты счета, реквизиты транзакции и история.",
          viewType: "sub",
          status: "",
        },
        {
          title: "Корпоративная выплата",
          description:
            "Информация о счете(ах) и транзакции(ах): список счетов, реквизиты счета, реквизиты транзакции и история.",
          viewType: "unsub",
          status: "Премиум",
        },
      ],
    };
  },

  methods: {
    handleSub(sub, index) {
      const tmp = [...this.apiLibs];
      
      for(let i = 0; i < tmp.length; i++) {
        if(index === i) {
          tmp[i].viewType = sub === 'sub' ? 'unsub' : 'sub';
        }
      }

      this.apiLibs = tmp;
    }
  }
};
</script>

<style lang="scss" scoped>
$dark: #262c40;
$blue: #0066cc;

.application-detail {
  width: 100%;

  &__container {
    max-width: 1080px;
    padding-left: 95px;
    padding-top: 57px;
    box-sizing: border-box;
    min-height: calc(100vh - 346px);
  }

  &__header {
    display: flex;
    flex-direction: column;
    margin-bottom: 42px;
  }

  &__main {
    display: flex;
    justify-content: space-between;
    margin-bottom: 9px;
  }

  &__team-info {
    display: flex;
    justify-content: space-between;
  }

  &__title {
    font-size: 38px;
    font-weight: bold;
    color: #262c40;
  }

  &__removeBtn {
    font-size: 18px;
    color: #262c40;
    outline: none;
    border: none;
    background-color: transparent;
  }

  &__team,
  &__owner {
    display: flex;
  }

  &__owner-name,
  &__team-name {
    font-size: 18px;
    color: $dark;
  }

  &__team-label,
  &__owner-label {
    font-size: 18px;
    color: $blue;
    margin-right: 10px;
  }

  &__content {
    margin-bottom: 48px;
  }

  &__subTitle {
    color: $dark;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 15px;
  }

  &__cards {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  &__card-item {
    margin-bottom: 20px;
  }
}
</style>