const { mix } = require('laravel-mix');

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
 /*
var modules = mix.resolve.modules;
	modules.push(path.resolve(__dirname, 'bower_components'));

mix.webpackConfig({
    resolve: {
        modules: modules
    }
});
*/


mix.js('resources/assets/js/app.js', 'public/js')
	.scripts([
			'bower_components/eonasdan-bootstrap-datetimepicker/build/js/tempusdominus-core.min.js'
		], 'public/js/app_addons.js')
   .sass('resources/assets/sass/app.scss', 'public/css');
