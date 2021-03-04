/* eslint-disable import/no-extraneous-dependencies */

const mix = require('laravel-mix');

mix.options({ clearConsole: false });
mix.setPublicPath('./public/content/themes/app/dist');

mix.css('resources/css/app.css', 'css');

mix.js('resources/js/app.js', 'js')
    .autoload({ jquery: ['$', 'window.jQuery'] })
    .extract();

// mix
//   .copyDirectory('resources/images', 'public/images')
//   .copyDirectory('resources/fonts', 'public/fonts');

mix.sourceMaps();
mix.version();
