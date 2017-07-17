import Vue from 'vue';
import Router from 'vue-router';
import Install from '../components/Install.vue';

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'install',
            component: Install,
        },
    ],
});