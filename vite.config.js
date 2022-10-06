import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: `
          @import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
          @import '@fortawesome/fontawesome-free/scss/solid.scss';
          `
        },
      },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
