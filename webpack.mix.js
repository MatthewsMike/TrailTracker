const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(['resources/js/app.js'], 'public/js/app.js')
    .scripts(['resources/js/klokantech.maptilerlayer.v1.js', 'resources/js/map_helper.js' ], 'public/js/all.js')
    .sass('resources/sass/app.scss', 'public/css');
