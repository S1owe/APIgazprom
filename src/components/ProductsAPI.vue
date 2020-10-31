<template>
  <div class="products-api">
    <div class="products-api__header">
      <h1 class="products-api__title"><a name="products_api">Продукты API</a></h1>
      <p class="products-api__header-text">
        Познакомьтесь с семейством продуктов Газпромбанк API. Изучите продукты и
        узнайте,<br />
        что они могут для вас сделать. Здесь вы найдете подробную документацию
        по каждому API-сервису,<br />
        включающую в себя описание сценариев использования и интерактивную
        песочницу.
      </p>
    </div>

    <div class="products-api__container">
      <h2 class="products-api__containerTitle">Газпромбанк ID (вход) API</h2>

      <div class="products-api__containerWrap">
        <div
          class="products-api__product-item"
          v-for="(item, i) in product1"
          :key="i"
        >
          <product-card
            :title="item.title"
            :description="item.description"
            :status="item.status"
            :link-url="item.link"
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

    <div class="products-api__container">
      <h2 class="products-api__containerTitle">Газпромбанк ID (вход) API</h2>

      <div class="products-api__containerWrap">
        <div
          class="products-api__product-item"
          v-for="(item, i) in product2"
          :key="i"
        >
          <product-card
            :title="item.title"
            :description="item.description"
            :status="item.status"
            :link-url="item.link"
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

    <div class="products-api__container">
      <h2 class="products-api__containerTitle">Газпромбанк ID (вход) API</h2>

      <div class="products-api__containerWrap">
        <div
          class="products-api__product-item"
          v-for="(item, i) in product3"
          :key="i"
        >
          <product-card
            :title="item.title"
            :description="item.description"
            :status="item.status"
            :link-url="item.link"
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

    <div class="products-api__container">
      <h2 class="products-api__containerTitle">Газпромбанк ID (вход) API</h2>

      <div class="products-api__containerWrap">
        <div
          class="products-api__product-item"
          v-for="(item, i) in product4"
          :key="i"
        >
          <product-card
            :title="item.title"
            :description="item.description"
            :status="item.status"
            :link-url="item.link"
            link-text="Документация"
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

    <BlockQuestions />
  </div>
</template>

<script>
import BlockQuestions from "./blocks/BlockQuestions";
import ProductCard from "./cards/ProductCard";

export default {
  name: "ProductsAPI",

  components: { BlockQuestions, ProductCard },

  data() {
    return {
      product1: [
        {
          link: '/doc/api/5.6.11',
          status: "Премиум",
          title: "Мгновенная отчетность",
          description:
            "Предоставление информации об остатках на счетах и ​​дневной выписке в режиме реального времени для вашего бизнеса.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "Премиум",
          title: "Мгновенная отчетность\n",
          description:
            "Позволяет корпоративным клиентам инициировать платежи через прямой системный интерфейс и получать подтверждение платежа.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "Премиум",
          title: "FX сделки",
          description:
            "Автоматически выполняйте сделки FX Spot из ваших систем и в соответствии с вашими собственными правилами.",
        },
      ],
      product2: [
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Корпоративная выплата",
          description:
            "Позволяет корпоративным клиентам инициировать платежи через прямой интерфейс системы и получать мгновенное подтверждение. ",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Лидогенерация",
          description:
            "Привлекайте новых клиентов в Банк через заявки на выпуск карт, выдачу кредита, открытие счета из ваших приложений и зарабатывайте.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Корпоративная выплата",
          description:
            "Позволяет корпоративным клиентам инициировать платежи через прямой интерфейс системы и получать мгновенное подтверждение. ",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Лидогенерация",
          description:
            "Привлекайте новых клиентов в Банк через заявки на выпуск карт, выдачу кредита, открытие счета из ваших приложений и зарабатывайте.",
        },
      ],
      product3: [
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Корпоративная выплата",
          description:
            "Позволяет корпоративным клиентам инициировать платежи через прямой интерфейс системы и получать мгновенное подтверждение. ",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Лидогенерация",
          description:
            "Привлекайте новых клиентов в Банк через заявки на выпуск карт, выдачу кредита, открытие счета из ваших приложений и зарабатывайте.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
      ],
      product4: [
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
        {
          link: '/doc/api/5.6.11',
          status: "",
          title: "Открытые справочники",
          description:
            "Используйте справочники общего назначения для передачи справочных значений в поля API.",
        },
      ],
    };
  },
};
</script>

<style lang="scss" scoped>
@import "../assets/scss/index.scss";
@import "../styles_fonts";

$blue: #0066cc;
$dark: #262c40;

.products-api {
  width: 100%;
  margin-bottom: 0px;

  &__header {
    display: flex;
    align-items: center;
    flex-direction: column;
    padding: 115px 240px 110px 240px;
    box-sizing: border-box;
  }

  &__title {
    text-align: center;
    color: $blue;
    font-size: 48px;
    font-weight: bold;
    margin-bottom: 40px;
  }

  &__header-text {
    text-align: center;
    color: #262c40;
  }

  &__container {
    padding: 0px 245px;
    margin-bottom: 90px;
  }

  &__containerTitle {
    color: $blue;
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 40px;
  }

  &__containerWrap {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }

  &__product-item {
    margin-bottom: 27px;
    margin-right: 5px;
    margin-left: 5px;
  }
}
</style>
