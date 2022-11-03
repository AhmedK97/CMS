import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/sb-admin-2.js',
                'resources/js/sb-admin-2.min.js',

                'resources/css/custom.css',
                'resources/css/sb-admin-2.css',
                'resources/css/sb-admin-2.min.css',


                // 'resources/js/bootstrap.js',

            ],
            refresh: true,
        }),
    ],
});
