import { createApp, h } from "vue";

import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";

import Default from "~/layouts/default.vue";

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
                const page = module.default;

                page.layout = page.layout || Default;
                return page;
            },
            
        }),
})
    .use(InertiaPlugin)
    .mount(app);
