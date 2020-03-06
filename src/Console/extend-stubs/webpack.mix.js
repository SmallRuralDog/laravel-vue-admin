let mix = require('laravel-mix')

mix
    .setPublicPath('dist')
    .js('resources/js/extend.js', 'js')
    .sass('resources/sass/extend.scss', 'css');
