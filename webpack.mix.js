let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.browserSync('invoice-ttr.slk');

mix.browserSync({
    proxy: 'invoice-ttr.slk',
    open: false,
    watchOptions: {
        usePolling: true,
        interval: 500,
    },
});