/// <reference types="vitest" />
/// <reference types="vite-svg-loader" />

import path from "path";
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import svgLoader from 'vite-svg-loader'

export default defineConfig(({ command }) => ({
    base: command === "serve" ? "" : "/build/",
    build: {
        manifest: true,
        emptyOutDir: true,
        rollupOptions: {
            input: "resources/js/main.ts",
        },
    },
    resolve: {
        alias: {
            "~": path.resolve(__dirname, "resources/js"),
        },
    },
    plugins: [vue(), svgLoader()],
    test: {
        globals: true,
        environment: "jsdom",
        
    },
    optimizeDeps: {
        include: ["vue", "@inertiajs/inertia"],
    },
}));
