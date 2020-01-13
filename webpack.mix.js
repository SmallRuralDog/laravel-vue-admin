const mix = require('laravel-mix');


mix
    .js('resources/js/app.js', 'public')
    .extract([
        'axios',
        'vue'
    ])
    .setPublicPath('public')
    .copy('public', '../../../public/vendor/laravel-vue-admin')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/'),
            },
        },
    })
    .version()
