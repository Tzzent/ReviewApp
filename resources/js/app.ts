import './bootstrap';
import '../css/app.css';

import { createPinia } from 'pinia';
import { modal } from "momentum-modal";
import { OhVueIcon, addIcons } from "oh-vue-icons";
import { MdPetsTwotone, CoGithub, FcGoogle, BiLinkedin, BiCardImage } from "oh-vue-icons/icons";

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Store';

addIcons(
    MdPetsTwotone,
    CoGithub,
    FcGoogle,
    BiLinkedin,
    BiCardImage,
);

createInertiaApp({
    title: (title) => `${title}${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component("v-icon", OhVueIcon)
            .use(createPinia())
            .use(modal, {
                resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
            })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
