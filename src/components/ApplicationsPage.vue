<template>
  <div class="applications-page">
    <div class="applications-page__container">
      <div class="applications-page__header">
        <h2 class="applications-page__title">Приложения</h2>

        <button class="applications-page__createAppBtn">
          Создать приложение
        </button>
      </div>

      <div class="applications-page__main">
        <router-link :to="{name: 'app-details', params: {appId: item.href}}"
          class="applications-page__app-item"
          v-for="(item, i) in apps"
          :key="i"
        >
          <application-card
            :title="item.title"
            :owner="item.owner"
            :team="item.team"
            :createdDate="item.date"
            viewType="application"
          />
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import ApplicationCard from "./cards/ApplicationCard";

export default {
  name: "ApplicationsPage",

  components: {
    ApplicationCard,
  },

  data() {
    return {
      apps: [
        {
          title: "Мое приложение 1",
          owner: "Зиновьев Ярослав",
          team: "API для банкоматов",
          date: new Date(`September 17, 2020 03:24:00`),
          href: 'h1',
        },
        {
          title: "Dikatro app test",
          owner: "Куйбышев Иван",
          team: "команда А",
          date: new Date(`October 25, 2020 03:24:00`),
          href: 'h2'
        },
      ],
    };
  },
};
</script>

<style lang="scss" scoped>
.applications-page {
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
    justify-content: space-between;
    align-items: center;
    margin-bottom: 27px;
  }

  &__title {
    font-size: 38px;
    font-weight: bold;
    color: #262c40;
  }

  &__createAppBtn {
    font-size: 18px;
    color: #262c40;
    outline: none;
    border: none;
    background-color: transparent;
  }

  &__main {
    display: flex;
    justify-content: space-between;
  }
}
</style>
