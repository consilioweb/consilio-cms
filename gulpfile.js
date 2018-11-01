const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
require('gulp');


elixir((mix) => {

	/* SCSS App */
	mix.sass('app.scss')
	.webpack('app.js');



	/*------------------------------------------------------------------------*/
	/* SITE */
	/*------------------------------------------------------------------------*/

	/* SCSS Site */
	mix.sass('resources/assets/sass/site/pages/home.scss', 'public/css/site/site-home.css');

	/* JS Libs Site */
	mix.scripts([
		'resources/assets/js/site/libs/jquery-ui.js',
		], 'public/js/site/site-home-libs.js'); 

	/* JS Site */
	mix.scripts([
		'resources/assets/js/site/modules/home.js',
		], 'public/js/site/site-home.js'); 



















	/*------------------------------------------------------------------------*/
	/* CMS */
	/*------------------------------------------------------------------------*/

	/* SCSS Cms */
	mix.sass('resources/assets/sass/cms/style.scss', 'public/css/cms/style.css');
	mix.sass(['resources/assets/sass/cms/pages/dashboard.scss'], 'public/css/cms/cms-dashboard.css');
	mix.sass(['resources/assets/sass/cms/pages/contents.scss'], 'public/css/cms/cms-contents.css');
	mix.sass(['resources/assets/sass/cms/pages/modules.scss'], 'public/css/cms/cms-modules.css');

	mix.sass(['resources/assets/sass/cms/pages/contents-unic.scss'], 'public/css/cms/cms-contents-unic.css');
	mix.sass(['resources/assets/sass/cms/pages/contents-list-create.scss'], 'public/css/cms/cms-contents-list-create.css');

	mix.sass(['resources/assets/sass/cms/pages/categories-create.scss'], 'public/css/cms/cms-categories-create.css');


	/* JS Libs Cms */
	 mix.scripts([
	 	'resources/assets/js/libs/jquery/dist/jquery.min.js',
	 	'resources/assets/js/libs/popper.js/dist/umd/popper.min.js',
	 	'resources/assets/js/libs/bootstrap/dist/js/bootstrap.min.js',
	 	'resources/assets/js/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js',
	 	'resources/assets/js/libs/sparkline/sparkline.js',
	 	], 'public/js/cms/app-libs.js'); 

	 mix.scripts([
	 	'resources/assets/js/cms/dist/app.min.js',
	 	'resources/assets/js/cms/dist/app.init.js',
	 	'resources/assets/js/cms/dist/app-style-switcher.js',
	 	'resources/assets/js/cms/dist/waves.js',
	 	'resources/assets/js/cms/dist/sidebarmenu.js',
	 	'resources/assets/js/cms/dist/custom.min.js',
	 	'resources/assets/js/cms/dist/dropdown-bootstrap-extended.js',
	 	], 'public/js/cms/app.js'); 




	// ~~ ~~ ~~ ~~ ~~ ~~ ~~ ~~ ~~ ~~ ~~
	// # JS PAGES
	// ~~ ~~ ~~ ~~ ~~ ~~ ~~ ~~ ~~ ~~ ~~



	/* LIBS */

	mix.scripts([
		'resources/assets/js/libs/chartist/dist/chartist.min.js',
		'resources/assets/js/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js',
		], 'public/js/cms/cms-dashboard-libs.js'); 


	mix.scripts([
		'resources/assets/js/cms/libs/select2.min.js',
		'resources/assets/js/cms/libs/bootstrap-datepicker.min.js',
		], 'public/js/cms/cms-contents-list-create-libs.js'); 	
	mix.scripts([
		'resources/assets/js/cms/libs/select2.min.js',
		], 'public/js/cms/cms-categories-create-libs.js'); 	


	/* MODULES */

	mix.scripts([
		'resources/assets/js/cms/modules/graphs_dashboard.js',
		], 'public/js/cms/cms-dashboard.js'); 
	
	mix.scripts([
		'resources/assets/js/cms/modules/preview.file.js',
		'resources/assets/js/cms/modules/ck.editor.js',
		], 'public/js/cms/cms-contents-unic.js'); 	
	mix.scripts([
		'resources/assets/js/cms/modules/preview.file.js',
		'resources/assets/js/cms/modules/ck.editor.js',
		'resources/assets/js/cms/modules/select2.js',
		'resources/assets/js/cms/modules/datapicker.js',
		], 'public/js/cms/cms-contents-list-create.js'); 

	mix.scripts([
		'resources/assets/js/cms/modules/select2.js',
		], 'public/js/cms/cms-categories-create.js'); 	




	/*------------------------------------------------------------------------*/
	/* ERRORS */
	/*------------------------------------------------------------------------*/

	mix.sass('resources/assets/sass/cms/style.scss', 'public/css/core/style.css');
	mix.sass('resources/assets/sass/errors/core.scss', 'public/css/core/core.css');

	/* JS Libs Errors */
	mix.scripts([
		'resources/assets/js/cms/libs/jquery/dist/jquery.min.js',
		], 'public/js/core/app-libs.js'); 





	/*------------------------------------------------------------------------*/
	/* FILES */
	/*------------------------------------------------------------------------*/

	mix.copy('resources/assets/fonts', 'public/fonts');
	mix.copy('resources/assets/img', 'public/img');


});
