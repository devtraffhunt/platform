import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //шаблон
                'resources/css/app.css',
                'resources/js/app.js',
                //Авторизация и регистрация
                'resources/js/pages/auth.js',
                'resources/css/pages/auth.css',
                //игры
                'resources/css/pages/games.css',
                'resources/js/pages/games.js',
            ],
            refresh: true,
        }),
    ],
});
