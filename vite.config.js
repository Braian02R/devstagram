import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        https: true, // Esto asegurará que Vite sirva con HTTPS en desarrollo
        hmr: {
            host: 'localhost'
        },
    }
});
