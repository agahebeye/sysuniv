import { createApp, h } from "vue";

import {
    App as InertiaApp,
    plugin as InertiaPlugin,
usePage,
} from "@inertiajs/inertia-vue3";

const app = document.getElementById("app");

const pages = import.meta.glob("./pages/**/*.vue");


createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: async (name) => {
                const importPage = pages[`./pages/${name}.vue`];
                if (!importPage) {
                    throw new Error(
                        `Unknown page ${name}. Is it located under Pages with a .vue extension?`
                    );
                }
                const module = await importPage();
                return module.default;
            },
            
        }),
        provide: {
            ziggy: usePage().props.value
        }
})
    .use(InertiaPlugin)
    .mount(app);
