import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ['css/resources/app.css', 'resources/js/app.js'],
            refresh: true,
            
        }),
       vue({
        template : {
            transformAssetUrls: {
                base: null,
                includeAbsolute: false,
            }
        }
       }),
    ],   
});