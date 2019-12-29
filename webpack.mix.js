const mix = require('laravel-mix');


mix.js('vue/app.js', './resources/js');


mix.copy('./resources/js/app.js', '../../../public/js/app.js');

mix.copyDirectory('./resources/fonts', '../../../public/fonts');
