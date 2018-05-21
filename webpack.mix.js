const mix = require("laravel-mix");

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

mix.
    options({
      uglify: {
        uglifyOptions: {
          compress: {
            drop_console: true,
          },
        },
      },
    }).
    setPublicPath("public").
    js("resources/assets/js/app.js", "public/js").
    extract([
      "jquery", "vue", "axios",
      "codemirror",
    ]).
    sass("resources/assets/sass/app.scss", "public/css").
    copy("public", "../../../public/vendor/server-dashboard");

if (mix.inProduction()) {
  mix.sourceMaps(false).version();
} else {
  mix.sourceMaps(true);
}

mix.webpackConfig({
  resolve: {
    alias: {
      "vue$": "vue/dist/vue.runtime.esm.js",
    },
  },
});
