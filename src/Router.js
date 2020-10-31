import Vue from 'vue';
import VueRouter from 'vue-router';

import MainComponent from './components/MainComponent.vue';
import ApiDoc from "@/components/doc/ApiDoc";
import Auth from './components/Auth.vue';
import ProductsAPI from './components/ProductsAPI.vue';
import AnalyticComponent from './components/AnalyticComponent.vue';
import ApplicationsPage from './components/ApplicationsPage.vue';
import TeamsPage from './components/TeamsPage.vue';
import ApplicationDetail from './components/ApplicationDetail.vue';
import TeamDetail from './components/TeamDetail.vue';
import FeedBack from "@/components/Feedback/FeedBack";
import AnalyticListComponent from "@/components/AnalyticListComponent";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
      {
          path: '/',
          name: 'main',
          meta: [null, null, 'Главная'],
          component: MainComponent,
          props: true
      },
      {
        path: '/doc/api/:version/:module?/',
        name: 'api_doc',
        meta: [null, null, 'Документация'],
        component: ApiDoc,
        props: true
      },
      {
        path: '/auth',
        name: 'auth',
        component: Auth,
        meta: [null, null, 'Авторизация'],
        props: true,
      },
      {
          path: '/products',
        name: 'products',
        meta: [null, null, 'Продукты'],
        component: ProductsAPI,
        props: true,
      },
      {
        path: '/applications',
        name: 'applications',
        meta: ['lk', 'applications', 'Приложения'],
        component: ApplicationsPage,
        props: true,
      },
      {
        path: '/applications/:appId',
        name: 'app-details',
        meta: ['lk', 'applications', 'Приложения'],
        component: ApplicationDetail,
        props: true,
      },
      {
        path: '/teams',
        name: 'teams',
        meta: ['lk', 'teams', 'Команды'],
        component: TeamsPage,
        props: true
      },
      {
        path: '/teams/:teamId',
        name: 'team-details',
        meta: ['lk', 'teams', 'Команды'],
        component: TeamDetail,
        props: true,
      },
      {
        path: '/analytics',
        name: 'analytics',
        meta: ['lk', 'analytics', 'Аналитика'],
        component: AnalyticListComponent,
        props: true,
      },
      {
        path: '/analytics/:teamId',
        name: 'analytic-item',
        meta: ['lk', 'analytics', 'Аналитика'],
        component: AnalyticComponent,
        props: true,
      },
      {
        path: '/feedback',
        name: 'feedback',
        meta: ['lk', 'feedback', 'Обратная связь'],
        component: FeedBack,
        props: true
      },
      {path: '*', redirect: '/'},
    ],
});

router.beforeEach((to, from, next) => {
  document.title = to.meta[2];
  next();
})

export default router;
