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

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/home.js','public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .autoload({
        jquery: ['$', 'jQuery', 'jquery', 'window.jQuery'],
        'popper.js/dist/umd/popper.js': ['Popper']
    })
    .extract(['jquery-slimscroll','metismenu'])
    .sass('resources/sass/home.scss','public/css')
    .copy('resources/assets/vendors/chart.js/dist/Chart.min.js','public/js')
    .copyDirectory('resources/homeTemplate/vendor/MagnificPopup','public/vendor/MagnificPopup')
    .copyDirectory('resources/assets/img','public/img')
    .copyDirectory('resources/homeTemplate/images','public/images')
;

if(mix.inProduction()){
    mix.version();
}
