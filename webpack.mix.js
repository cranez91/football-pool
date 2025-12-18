const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .vue({ version: 2 });

if (mix.inProduction()) {
    mix.version();
}
