import WeChat from '../pages/WeChat.vue';

export default function (injection) {
    injection.useExtensionRoute([
        {
            beforeEnter: injection.middleware.requireAuth,
            component: WeChat,
            path: 'wechat-login',
        },
    ]);
}
