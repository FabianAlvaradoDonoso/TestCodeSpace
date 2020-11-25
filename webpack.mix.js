const mix = require('laravel-mix');

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

mix.scripts(
	[
		'resources/Complementos/Adminlte/bower_components/jquery/dist/jquery.min.js',
		'resources/Complementos/Adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js',
		'resources/Complementos/Adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
		'resources/Complementos/Adminlte/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js',
		'resources/Complementos/Adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js',
		'resources/Complementos/Adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
		'resources/Complementos/Adminlte/plugins/iCheck/icheck.min.js',
		'resources/Complementos/Adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
		'resources/Complementos/Adminlte/bower_components/fastclick/lib/fastclick.js',
		'resources/Complementos/Adminlte/dist/js/adminlte.min.js',
		'resources/Complementos/Adminlte/dist/js/demo.js',
		'resources/Complementos/bootstrap-notify/bootstrap-notify.js'
	],
	'public/js/app.js'
);
mix.styles(
	[
		'resources/Complementos/Adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css',
		'resources/Complementos/Adminlte/bower_components/font-awesome/css/font-awesome.min.css',
		'resources/Complementos/Adminlte/bower_components/Ionicons/css/ionicons.min.css',
		'resources/Complementos/Adminlte/dist/css/AdminLTE.min.css',
		'resources/Complementos/Adminlte/dist/css/skins/_all-skins.min.css',
		'resources/Complementos/Adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
		'resources/Complementos/Adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
		'resources/Complementos/Adminlte/plugins/iCheck/all.css',
		'resources/Complementos/animate/animate.css'
	],
	'public/css/app.css'
);
