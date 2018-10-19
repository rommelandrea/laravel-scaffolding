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

mix.styles([
    //
], 'public/app.css');

mix.scripts([
    //
], 'public/app.js');

mix.copyDirectory('resources/assets/images', 'public/images');

if (mix.inProduction()) {
    mix.version();
}