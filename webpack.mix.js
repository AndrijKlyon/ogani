const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

 // site
mix.styles([
    'resources/ogani/css/bootstrap.min.css',
    'resources/ogani/css/font-awesome.min.css',
    'resources/ogani/css/elegant-icons.css',
    'resources/ogani/css/nice-select.css',
    'resources/ogani/css/jquery-ui.min.css',
    'resources/ogani/css/owl.carousel.min.css',
    'resources/ogani/css/slicknav.min.css',
    'resources/ogani/css/style.css',
 ], 'public/css/basetemplate.css').purgeCss();

 mix.scripts([
    'resources/ogani/js/jquery-3.3.1.min.js',
    'resources/ogani/js/bootstrap.min.js',
    'resources/ogani/js/jquery.nice-select.min.js',
    'resources/ogani/js/jquery-ui.min.js',
    'resources/ogani/js/jquery.slicknav.js',
    'resources/ogani/js/mixitup.min.js',
    'resources/ogani/js/owl.carousel.min.js',
    'resources/ogani/js/main.js',
 ], 'public/js/basetemplate.js');

 mix.styles([
    'resources/css/jquery.typeahead.min.css',
    'resources/css/custom.css',
 ], 'public/css/custom.css').purgeCss();

 mix.scripts([
    'resources/js/validator.js',
    'resources/js/jquery.typeahead.min.js',
    'resources/js/custom.js',
 ], 'public/js/custom.js');

 mix.scripts([
    'resources/js/rater.min.js',
    'resources/js/products.js',
 ], 'public/js/products.js');

 mix.scripts([
    'resources/js/blog_custom.js',
 ], 'public/js/blog.js');

//  admin

 mix.styles([
    'node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css',
    'node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css',
    'node_modules/admin-lte/dist/css/AdminLTE.min.css',
    'node_modules/admin-lte/dist/css/skins/skin-blue.min.css',
    'node_modules/admin-lte/bower_components/select2/dist/css/select2.css',
    'node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'
 ], 'public/css/admin.css');

 mix.scripts([
    'node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js',
    'node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/admin-lte/dist/js/adminlte.min.js',
    'node_modules/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
    'node_modules/admin-lte/bower_components/fastclick/lib/fastclick.js',
    'node_modules/admin-lte/bower_components/select2/dist/js/select2.full.js',
    'node_modules/admin-lte/bower_components/select2/dist/js/i18n/ru.js',
    'node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.ru.min.js'
 ], 'public/js/admin.js');

 mix.styles([
     'resources/css/custom_admin.css',
     'resources/css/jquery.typeahead.min.css',
     'node_modules/admin-lte/plugins/iCheck/flat/blue.css',
     'resources/css/bootstrap-toggle.min.css'
  ], 'public/css/custom_admin.css').purgeCss();

 mix.js(['resources/js/custom_admin.js',
         'resources/js/validator.js',
         'resources/js/jquery.typeahead.min.js',
         'node_modules/admin-lte/plugins/iCheck/icheck.min.js',
         'resources/js/bootstrap-toggle.min.js',
      ], 'public/js');

 mix.scripts([
     'resources/js/dropzone.js',
     'resources/js/dropzone_custom.js',
  ], 'public/js/dropzone.js');

  mix.styles([
    'node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
 ], 'public/css/custom_mailbox.css').purgeCss();

 mix.scripts([
     'node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
     'resources/js/mailbox_custom.js'
  ], 'public/js/custom_mailbox.js');
