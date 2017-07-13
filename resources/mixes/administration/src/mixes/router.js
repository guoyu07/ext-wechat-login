import Baidu from '../pages/Baidu.vue';

export default function (injection) {
    injection.useExtensionRoute([
        {
            beforeEnter: injection.middleware.requireAuth,
            component: Baidu,
            path: 'search',
        },
    ]);
}
