<template>
  <div class="col-3 sidebar d-flex flex-column p-0">
    <div class="fixed_container">
      <div class="point mt-4 mr-2 ml-4" v-for="point in points" :key="point.name">
        <b-button variant="white"
                  @click="$route.name !== point.name ? $router.push({name: point.name}) : ''"
                  :class="{'not-collapsed': $route.meta[1] === point.name, collapsed: $route.meta[1] !== point.name}"
                  class="d-flex flex-column align-items-centertext-left collapse-btn p-0">
          <div class="w-100 d-flex text-left">
          <span class="icon mr-2" v-if="point.headers.length > 0">
            <svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 6L0.75 11.1962L0.75 0.803848L6 6Z" fill="#262C40"/>
            </svg>
          </span>
            <span>{{point.text}}</span>
          </div>
        </b-button>
        <b-collapse :visible="$route.meta[1] === point.name" v-if="point.headers.length > 0">
          <div class="w-100 ml-4">
            <ul class="list-items m-0 p-0">
              <li class="list-item pl-3" :class="{active: $route.path === head.href}" v-for="head in point.headers" :key="head.href">
                <router-link :to="head.href"><span>{{head.title}}</span></router-link>
              </li>
            </ul>
          </div>
        </b-collapse>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LeftSidebar",
  data: function () {
    return {
      points: [
        {
          text: 'Приложения',
          name: 'applications',
          headers: [
            {
              title: "Моё приложение 1",
              href: '/applications/h1'
            },
            {
              title: "Dikatro app test",
              href: '/applications/h2'
            }
          ]
        },
        {
          text: 'Команды',
          name: 'teams',
          headers: [
            {
              title: "API для банкоматов",
              href: '/teams/h1'
            },
            {
              title: "Команда А",
              href: '/teams/h2'
            }
          ]
        },
        {
          text: 'Аналитика',
          name: 'analytics',
          headers: [
            {
              title: "API для банкоматов",
              href: '/analytics/h1'
            },
            {
              title: "Команда А",
              href: '/analytics/h2'
            }
          ]
        },
        {
          text: 'Обратная связь',
          name: 'feedback',
          headers: []
        }
      ]
    }
  }
}
</script>

<style scoped lang="scss">
@import "@/styles_fonts.scss";

.list-item {
  border-left: 3px #D7DEE9 solid;
}

.list-item.active {
  border-left: 3px #0066CC solid;
}

.sidebar {
  border-right: 2px solid #D7DEE9;
  overflow-y: auto;
  overflow-x: hidden;
  position: relative;

  .fixed_container {
    position: fixed;
  }

  p, h1, h2, h3, h4, h5, span, td, th {
    font-family: 'ProximaNova-Regular';
    font-size: 18px;
  }
}
</style>
