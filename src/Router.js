import Vue from 'vue';
import VueRouter from 'vue-router';

import MainComponent from './components/MainComponent.vue';
import ApiDoc from "@/components/doc/ApiDoc";
import Auth from './components/Auth.vue';
import ProductsAPI from './components/ProductsAPI.vue';
import AnalyticComponent from './components/АnalyticComponent.vue';
import ApplicationsPage from './components/ApplicationsPage.vue';
import TeamsPage from './components/TeamsPage.vue';
import ApplicationDetail from './components/ApplicationDetail.vue';
import TeamDetail from './components/TeamDetail.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'main',
            component: MainComponent,
            props: true
        },
      {
        path: '/doc/api/:version/:module?/',
        name: 'api_doc',
        component: ApiDoc,
        props: true
      },
      {
        path: '/auth',
        name: 'auth',
        component: Auth,
        props: true,
      },
      {
        path: '/products',
        name: 'products',
        component: ProductsAPI,
        props: true,
      },
      {
        path: '/analytics',
        name: 'analytics',
        component: AnalyticComponent,
        props: true,
      },
      {
        path: '/applications',
        name: 'applications',
        meta: ['lk', 'applications'],
        component: ApplicationsPage,
        props: true,
      },
      {
        path: '/applications/:appId',
        name: 'app-details',
        meta: ['lk', 'applications'],
        component: ApplicationDetail,
        props: true,
      },
      {
        path: '/teams',
        name: 'teams',
        meta: ['lk', 'teams'],
        component: TeamsPage,
        props: true
      },
      {
        path: '/teams/:teamId',
        name: 'team-details',
        meta: ['lk', 'teams'],
        component: TeamDetail,
        props: true,
      },
      {path: '*', redirect: '/'},
    ],
});

export default router;
