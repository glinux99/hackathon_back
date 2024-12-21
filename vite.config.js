import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
export default defineConfig({
    plugins: [
        laravel({
            hotFile: 'storage/vite.hot', // Customize the "hot" file...
            buildDirectory: 'bundle',
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
            build: {
                manifest: 'assets.json', // Customize the manifest filename...
              },
        }),
        vue(),
    ],
});
