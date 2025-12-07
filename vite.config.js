import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.scss",
                "resources/js/app.js",
                "resources/css/admin.scss",
                "resources/js/admin.js",
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                // Silences the warnings for deprecated Sass color functions
                silenceDeprecations: ["color-functions"],
            },
        },
    },
});
