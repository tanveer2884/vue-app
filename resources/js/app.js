import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { InertiaProgress } from '@inertiajs/progress';
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/md-light-indigo/theme.css'; // Choose a theme from PrimeVue
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

InertiaProgress.init();
