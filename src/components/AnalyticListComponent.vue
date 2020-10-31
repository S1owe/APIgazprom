<template>
  <div class="team-page">
    <div class="team-page__container">
      <div class="team-page__header">
        <h2 class="team-page__title">Команды</h2>
      </div>

      <div class="team-page__main">
        <router-link :to="{name: 'analytic-item', params: {teamId: item.href}}"
                     class="team-page__app-item"
                     v-for="(item, i) in teams"
                     :key="i"
        >
          <application-card
            :title="item.title"
            :owner="item.owner"
            :members="item.members"
            :createdDate="item.createdDate"
            viewType="team"
          />
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import ApplicationCard from "./cards/ApplicationCard";

export default {
  name: "AnalyticListComponent",
  components: { ApplicationCard },

  data() {
    return {
      teams: [
        {
          title: 'API для банкоматов',
          createdDate: new Date('August 19, 2020 03:24:00'),
          owner: 'Зиновьев Ярослав',
          members: ['Зиновьев Ярослав', 'Туркин Илья', 'Тургенев Николай', 'Сусликов Иван и др.'],
          href: 'h1'
        },
        {
          title: 'команда А',
          createdDate: new Date('October 20, 2020 03:24:00'),
          owner: 'Куйбышев Иван',
          members: ['Куйбышев Иван', 'Туркин Илья', 'Тургенев Николай', 'Сусликов Иван и др.'],
          href: 'h2'
        }
      ]
    }
  }
}
</script>

<style lang="scss" scoped>
.team-page {
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
