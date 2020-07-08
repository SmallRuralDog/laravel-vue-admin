const mix = require("laravel-mix");

mix.config.webpackConfig.output = {
  publicPath: "/vendor/laravel-vue-admin/",
};


mix
  .js("resources/js/app.js", "public")
  .extract(["axios", "vue", "vuex", "vue-router", "element-ui"])
  .setResourceRoot("/vendor/laravel-vue-admin")
  .setPublicPath("public")
  .copy("public", "../public/vendor/laravel-vue-admin")
  .webpackConfig({
    resolve: {
      alias: {
        "@": path.resolve(__dirname, "resources/js/"),
      },
    },
    module: {
      rules: [],
    },
  })
  .options({
    extractVueStyles: false,
    processCssUrls: false,
  })
  .disableNotifications().version();

