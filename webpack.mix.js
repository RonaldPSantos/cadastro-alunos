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

mix.sass('node_modules//bootstrap/scss/bootstrap.scss', 'public/css/bootstrap.css')
    .sass('resources/sass/app.scss', 'public/css')
    .js('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
    .js('node_modules//bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
    .js('resources/js/app.js', 'public/js');
