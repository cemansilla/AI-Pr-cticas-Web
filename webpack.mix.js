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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/brainstorming.js', 'public/js')
    .js('resources/js/chat.js', 'public/js')
    .js('resources/js/obsidian.js', 'public/js')
    .js('resources/js/voice.js', 'public/js')
    .js('resources/js/image.js', 'public/js')
    .js('resources/js/post-rrss.js', 'public/js')
    .js('resources/js/sentiment.js', 'public/js')
    .js('resources/js/text-to-speech.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();