import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    base: process.env.ASSET_URL || '/',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~filament': path.resolve(__dirname, './vendor/filament/filament/resources/js'),
        },
    },
});
