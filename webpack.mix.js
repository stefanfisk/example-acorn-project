/* eslint-disable import/no-extraneous-dependencies */

const mix = require('laravel-mix');
const DependencyExtractionPlugin = require('@wordpress/dependency-extraction-webpack-plugin');

mix.options({ clearConsole: false });
mix.setPublicPath('./public/content/themes/app/dist');

mix.webpackConfig({
    plugins: [new DependencyExtractionPlugin()],
});

mix.css('resources/css/front.css', 'css')
    .css('resources/css/admin.css', 'css')
    .css('resources/css/editor.css', 'css');

mix.js('resources/js/front.js', 'js')
    .js('resources/js/admin.js', 'js')
    .js('resources/js/editor.js', 'js');

mix.sourceMaps();
mix.version();
