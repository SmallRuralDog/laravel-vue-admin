let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/form-item.js', 'js')
  .sass('resources/sass/form-item.scss', 'css')
