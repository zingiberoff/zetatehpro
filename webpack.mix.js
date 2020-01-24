const mix = require('laravel-mix');
mix.browserSync({
    proxy: 'http://desenhador_catalog.test'
});
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css').version();
