let mix = require('laravel-mix');

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

mix.js('admin/assets/app.js', 'public/js')
  .styles([
    'public/assets/font-awesome/css/font-awesome.css',
    'public/assets/ionicon/css/ionicons.min.css'
  ], 'public/css/myfonts.css')
  .styles([
    'public/css/vue-multiselect.min.css',
    'public/assets/modal-effect/css/component.css',
    'public/assets/timepicker/bootstrap-datepicker.min.css',
    'public/assets/notifications/notification.css',
    'public/css/style.css',
    'public/css/helper.css',
    'public/css/mystyles.css',
  ], 'public/css/csstyles.css').
mix.js([
  'public/assets/timepicker/bootstrap-datepicker.js',
  'public/assets/notifications/notify.min.js',
  'public/assets/notifications/notify-metro.js',
  'public/assets/notifications/notifications.js',
  'public/assets/modal-effect/js/classie.js',
  'public/assets/modal-effect/js/modalEffects.js',
  'public/js/jquery.app.js'
],'public/js/common.js')
  .extract(['vue','axios','vee-validate','vue-multiselect','moment','chart.js'])
  .mix.autoload({ jQuery: 'jquery', $: 'jquery', jquery: 'jquery' })
  .webpackConfig({
    output: {
      // chunkFilename: mix.inProduction() ? 'js/chunks/[name].[chunkhash].js' : 'chunks/[name].js',
      chunkFilename: `js/[name].chunk.js`,
      publicPath: '/',
    },
  })

