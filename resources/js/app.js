import './bootstrap';
import Alpine from 'alpinejs';
import { createApp }  from 'vue';
import { flashToast } from '@alamtheinnov/flashtoast';
import { createRouter, createWebHistory } from 'vue-router'

import App from './views/App.vue';

import Messages from './views/Messages.vue';
import MessagesSent from './views/MessagesSent.vue';
import MessagesArchived from './views/MessagesArchived.vue';
import ComposeMessage from './views/ComposeMessage.vue'

window.Alpine = Alpine;
Alpine.start();

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/messages',
            name: 'messages',
            component: Messages,
        },
        {
            path: '/messages/sent',
            name: 'messages.sent',
            component: MessagesSent,
        },
        {
            path: '/messages/archived',
            name: 'messages.archived',
            component: MessagesArchived,
        },
        {
            path: '/messages/compose',
            name: 'messages.compose',
            component: ComposeMessage,
        },
    ],
});

if (document.getElementById('app')) {
    createApp().component('app', App).use(router).use(flashToast).mount('#app');
}
