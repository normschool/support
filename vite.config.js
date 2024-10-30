import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/sass/custom.scss',
                'resources/assets/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
