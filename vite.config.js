import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
                    //css
                    'public/css/sb-admin-2.min.css',
                    'public/vendor/fontawesome-free/css/all.min.css',
                    //js
                    'public/vendor/jquery/jquery.min.js',
                    'public/vendor/bootstrap/js/bootstrap.bundle.min.js',
                    'public/vendor/jquery-easing/jquery.easing.min.js',
                    'public/js/sb-admin-2.min.js',
                    'public/vendor/chart.js/Chart.min.js',
                    'public/js/demo/chart-area-demo.js',
                    'public/js/demo/chart-pie-demo.js',
        ],
            refresh: true,
        }),
    ],
});
