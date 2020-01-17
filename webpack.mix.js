const mix = require('laravel-mix');


mix
    .js('resources/js/app.js', 'public')
    .extract([
        'axios',
        'vue',
        'vue-router',
        'element-ui',
        'view-design'
    ])
    .setResourceRoot('/vendor/laravel-vue-admin')
    .setPublicPath('public')
    .copy('public', '../../../public/vendor/laravel-vue-admin')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/'),
            },
        },
        module: {
            rules: [

            ]
        }
    })
    .options({
        extractVueStyles: false,
        processCssUrls: false,
    })
    .disableNotifications()
    .version()
