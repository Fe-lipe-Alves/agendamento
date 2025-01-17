const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/scss/app.scss', 'public/css');
mix.sass('resources/scss/login.scss', 'public/css');
mix.sass('resources/scss/agenda.scss', 'public/css');
mix.js('resources/js/agenda.js', 'public/js');



mix.webpackConfig(require('./webpack.config'));
