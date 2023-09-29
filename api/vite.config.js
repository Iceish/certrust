import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/styles/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        resolve: {
            alias: {
                '@': '/resources',
                '@js': '/resources/js',
                '@styles': '/resources/styles',
            },
        },
    },
    server: {
        hmr: {
            host: 'localhost'
        }
    }
});
