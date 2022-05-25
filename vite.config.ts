import path from "path";
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

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
    plugins: [vue()],
    optimizeDeps: {
        include: ["vue", "@inertiajs/inertia"],
    },
}));
