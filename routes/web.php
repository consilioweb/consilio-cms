<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* SITE */
Route::group(['namespace' => 'Site'], function() { 
	Route::get('/', array('as' => 'site-home', 'uses' => 'HomeController@index'));
});


/* CMS */
Route::group(['namespace' => 'Cms', 'prefix' => 'cms'], function() {
	/* Login */
	Route::get('auth', array('as'        => 'cms-auth', 'uses' => 'LoginController@index', 'nickname' => "Login do CMS"));	
	Route::post('auth', array('as'       => 'cms-auth', 'uses' => 'LoginController@authenticate', 'nickname' => "Login do CMS"));
	Route::get('logout', array('as' => 'cms-auth-logout', 'uses' => 'LoginController@logout', 'nickname' => "Logout do CMS"));
	Route::get('auth/forgot-password', array('as' => 'cms-auth-forgot', 'uses' => 'LoginController@logout', 'nickname' => "Logout do CMS"));

	/* Acesso */
	Route::group(['middleware' => 'auth:cms'], function() {
		Route::get('/', array('as' => 'cms-dashboard', 'uses' => 'DashboardController@index', 'nickname' => "Dashboard do CMS"));	

		Route::get('/configuracoes/sistema', array('as' => 'cms-settings-system', 'uses' => 'SettingsController@system', 'nickname' => "Configurações do CMS"));	
		Route::post('/configuracoes/sistema', array('as' => 'cms-settings-system-update', 'uses' => 'SettingsController@systemUpdate', 'nickname' => "Configurações do CMS"));	

		Route::get('/configuracoes/site', array('as' => 'cms-settings-site', 'uses' => 'SettingsController@site', 'nickname' => "Configurações do Site"));	
		Route::post('/configuracoes/site', array('as' => 'cms-settings-site-update', 'uses' => 'SettingsController@siteUpdate', 'nickname' => "Configurações do Site"));	



		Route::get('modulos', array('as'                              => 'cms-modules', 'uses' => 'ModulesController@index', 'nickname' => "Listar Modulos"));
		Route::get('modulos/novo', array('as'                         => 'cms-modules-create', 'uses' => 'ModulesController@create', 'nickname' => "Criar Modulos"));
		Route::post('modulos/novo', array('as'                        => 'cms-modules-create', 'uses' => 'ModulesController@store', 'nickname' => "Criar Modulos"));
		Route::get('modulos/{id}', array('as'                         => 'cms-modules-show', 'uses' => 'ModulesController@show', 'nickname' => "Visualizar Modulos"));
		Route::put('modulos/{id}', array('as'                         => 'cms-modules-update', 'uses' => 'ModulesController@update', 'nickname' => "Atualizar Modulos"));
		Route::get('modulos/excluir/{id}', array('as'                 => 'cms-modules-delete', 'uses' => 'ModulesController@destroy', 'nickname' => "Excluir Modulos"));
		Route::get('modulos/status/{id}/{action}', array('as'         => 'cms-modules-status', 'uses' => 'ModulesController@status', 'nickname' => "Status de Modulos"));

		Route::get('gerenciar/{modules_id}', array('as'  						=> 'cms-contents-list', 'uses' => 'ContentsListController@index', 'nickname' => "Listar Conteudo"));
		Route::get('gerenciar/{modules_id}/novo', array('as' 					=> 'cms-contents-list-create', 'uses' => 'ContentsListController@create', 'nickname' => "Criar Conteudo"));
		Route::post('gerenciar/{modules_id}/novo', array('as' 					=> 'cms-contents-list-create', 'uses' => 'ContentsListController@store', 'nickname' => "Salvar Conteudo"));		
		Route::get('gerenciar/{modules_id}/{contents_id}', array('as' 			=> 'cms-contents-list-show', 'uses' => 'ContentsListController@show', 'nickname' => "Visualizar Conteudo"));
		Route::put('gerenciar/{modules_id}/{contents_id}', array('as' 			=> 'cms-contents-list-update', 'uses' => 'ContentsListController@update', 'nickname' => "Atualizar Conteudo"));
		Route::get('gerenciar/excluir/{modules_id}/{contents_id}', array('as'	=> 'cms-contents-list-delete', 'uses' => 'ContentsListController@destroy', 'nickname' => "Excluir Conteudo"));
		Route::get('gerenciar/status/{modules_id}/{contents_id}/{action}', array('as' 	=> 'cms-contents-list-status', 'uses' => 'ContentsListController@status', 'nickname' => "Status de Conteudo"));
		Route::get('gerenciar/excluir/foto/{modules_id}/{contents_id}', array('as' 		=> 'cms-contents-list-delete-photo', 'uses' => 'ContentsListController@destroyPhoto', 'nickname' => "Excluir Imagem"));

		Route::get('pagina/{modules_id}/ver', array('as'  						=> 'cms-contents-unic', 'uses' 				=> 'ContentsUnicController@index', 'nickname' => "Visualizar Conteudo"));
		Route::post('pagina/{modules_id}/novo', array('as'  					=> 'cms-contents-unic-create', 'uses' 		=> 'ContentsUnicController@store', 'nickname' => "Criar Conteudo"));
		Route::put('pagina/{modules_id}/atualizar', array('as'  				=> 'cms-contents-unic-update', 'uses' 		=> 'ContentsUnicController@update', 'nickname' => "Atualizar Conteudo"));
		Route::get('pagina/excluir/foto/{modules_id}/{photo}', array('as' 		=> 'cms-contents-unic-delete-photo', 'uses' => 'ContentsUnicController@destroyPhoto', 'nickname' => "Excluir Imagem"));

		Route::get('galeria/{modules_id}/{contents_id}', array('as'  => 'cms-gallery', 'uses' => 'GalleryController@index', 'nickname' => "Listar Imagens"));
		Route::post('galeria/{modules_id}/{contents_id}', array('as'  => 'cms-gallery-upload', 'uses' => 'GalleryController@upload', 'nickname' => "Enviar Imagens"));
		Route::get('galeria/{modules_id}/{contents_id}/show', array('as'  => 'cms-gallery-list', 'uses' => 'GalleryController@show', 'nickname' => "Enviar Imagens"));
		Route::get('galeria/{modules_id}/{contents_id}/remove/{image}', array('as'  => 'cms-gallery-remove', 'uses' => 'GalleryController@remove', 'nickname' => "Remover Imagen"));

		Route::get('arquivos/{modules_id}/{contents_id}', array('as'  => 'cms-archives', 'uses' => 'ArchivesController@index', 'nickname' => "Listar Arquivos"));
		Route::post('arquivos/{modules_id}/{contents_id}', array('as'  => 'cms-archives-upload', 'uses' => 'ArchivesController@upload', 'nickname' => "Enviar Arquivos"));
		Route::get('arquivos/{modules_id}/{contents_id}/show', array('as'  => 'cms-archives-list', 'uses' => 'ArchivesController@show', 'nickname' => "Enviar Arquivos"));
		Route::get('arquivos/{modules_id}/{contents_id}/remove/{image}', array('as'  => 'cms-archives-remove', 'uses' => 'ArchivesController@remove', 'nickname' => "Remover Arquivos"));

		Route::get('categorias', array('as' => 'cms-categories', 'uses' => 'CategoriesController@index', 'nickname' => "Listar Categorias"));
		Route::get('categorias/novo', array('as' => 'cms-categories-create', 'uses' => 'CategoriesController@create', 'nickname' => "Criar Categorias"));
		Route::post('categorias/novo', array('as' => 'cms-categories-create', 'uses' => 'CategoriesController@store', 'nickname' => "Criar Categorias"));
		Route::get('categorias/{id}', array('as' => 'cms-categories-show', 'uses' => 'CategoriesController@show', 'nickname' => "Visualizar Categorias"));
		Route::put('categorias/{id}', array('as' => 'cms-categories-update', 'uses' => 'CategoriesController@update', 'nickname' => "Atualizar Categorias"));
		Route::get('categorias/excluir/{id}', array('as' => 'cms-categories-delete', 'uses' => 'CategoriesController@destroy', 'nickname' => "Excluir Categorias"));
		Route::get('categorias/status/{id}/{action}', array('as' => 'cms-categories-status', 'uses' => 'CategoriesController@status', 'nickname' => "Status de Categorias"));

		Route::get('usuarios', array('as' => 'cms-users', 'uses' => 'UsersController@index', 'nickname' => "Listar Usuários"));
		Route::get('usuarios/novo', array('as' => 'cms-users-create', 'uses' => 'UsersController@create', 'nickname' => "Criar Usuários"));
		Route::post('usuarios/novo', array('as' => 'cms-users-create', 'uses' => 'UsersController@store', 'nickname' => "Criar Usuários"));
		Route::get('usuarios/{id}', array('as' => 'cms-users-show', 'uses' => 'UsersController@show', 'nickname' => "Visualizar Usuários"));
		Route::put('usuarios/{id}', array('as' => 'cms-users-update', 'uses' => 'UsersController@update', 'nickname' => "Atualizar Usuários"));
		Route::get('usuarios/excluir/{id}', array('as' => 'cms-users-delete', 'uses' => 'UsersController@destroy', 'nickname' => "Excluir Usuários"));
		Route::get('usuarios/status/{id}/{action}', array('as' => 'cms-users-status', 'uses' => 'UsersController@status', 'nickname' => "Status de Usuários"));
		Route::get('usuarios/foto/{id}/{action}', array('as' => 'cms-users-photos', 'uses' => 'UsersController@destroyPhoto', 'nickname' => "Apagar Foto de Usuários"));


		/* ~~~~~~~~~~~~~~ BANNERS ~~~~~~~~~~~~~~~~~*/
		Route::get('plugins/anuncios/banners', array('as' 				=> 'cms-adverts', 'uses' => 'AdvertsController@index', 'nickname' => "Listar Banners de Anuncios"));
		Route::get('plugins/anuncios/banners/novo', array('as'          => 'cms-adverts-create', 'uses' => 'AdvertsController@create', 'nickname' => "Criar Banners de Anuncios"));
		Route::post('plugins/anuncios/banners/novo', array('as'         => 'cms-adverts-create', 'uses' => 'AdvertsController@store', 'nickname' => "Criar Banners de Anuncios"));
		Route::get('plugins/anuncios/banners/{id}', array('as'          => 'cms-adverts-show', 'uses' => 'AdvertsController@show', 'nickname' => "Visualizar Banners de Anuncios"));
		Route::put('plugins/anuncios/banners/{id}', array('as'          => 'cms-adverts-update', 'uses' => 'AdvertsController@update', 'nickname' => "Atualizar Banners de Anuncios"));
		Route::get('plugins/anuncios/banners/{id}/excluir', array('as'  => 'cms-adverts-delete', 'uses' => 'AdvertsController@destroy', 'nickname' => "Excluir Banners de Anuncios"));
		Route::get('plugins/anuncios/banners/{id}/{action}', array('as' => 'cms-adverts-status', 'uses' => 'AdvertsController@status', 'nickname' => "Status de Banners de Anuncios"));
		Route::get('plugins/anuncios/relatorio', array('as' 	=> 'cms-adverts-report', 'uses' => 'AdvertsController@report', 'nickname' => "Relatorio de Banners de Anuncios"));

		Route::get('plugins/anuncios/anunciantes', array('as' 				=> 'cms-advertisers', 'uses' => 'AdvertisersController@index', 'nickname' => "Listar Anunciantes"));
		Route::get('plugins/anuncios/anunciantes/novo', array('as'          => 'cms-advertisers-create', 'uses' => 'AdvertisersController@create', 'nickname' => "Criar Anunciantes"));
		Route::post('plugins/anuncios/anunciantes/novo', array('as'         => 'cms-advertisers-create', 'uses' => 'AdvertisersController@store', 'nickname' => "Criar Anunciantes"));
		Route::get('plugins/anuncios/anunciantes/{id}', array('as'          => 'cms-advertisers-show', 'uses' => 'AdvertisersController@show', 'nickname' => "Visualizar Anunciantes"));
		Route::put('plugins/anuncios/anunciantes/{id}', array('as'          => 'cms-advertisers-update', 'uses' => 'AdvertisersController@update', 'nickname' => "Atualizar Anunciantes"));
		Route::get('plugins/anuncios/anunciantes/{id}/excluir', array('as'  => 'cms-advertisers-delete', 'uses' => 'AdvertisersController@destroy', 'nickname' => "Excluir Anunciantes"));
		Route::get('plugins/anuncios/anunciantes/{id}/{action}', array('as' => 'cms-advertisers-status', 'uses' => 'AdvertisersController@status', 'nickname' => "Status de Anunciantes"));

		Route::get('plugins/anuncios/modulos', array('as' 				=> 'cms-adverts-locations', 'uses' => 'LocationsAdvertsController@index', 'nickname' => "Listar Local de Banners"));
		Route::get('plugins/anuncios/modulos/novo', array('as'          => 'cms-adverts-locations-create', 'uses' => 'LocationsAdvertsController@create', 'nickname' => "Criar Local de Banners"));
		Route::post('plugins/anuncios/modulos/novo', array('as'         => 'cms-adverts-locations-create', 'uses' => 'LocationsAdvertsController@store', 'nickname' => "Criar Local de Banners"));
		Route::get('plugins/anuncios/modulos/{id}', array('as'          => 'cms-adverts-locations-show', 'uses' => 'LocationsAdvertsController@show', 'nickname' => "Visualizar Local de Banners"));
		Route::put('plugins/anuncios/modulos/{id}', array('as'          => 'cms-adverts-locations-update', 'uses' => 'LocationsAdvertsController@update', 'nickname' => "Atualizar Local de Banners"));
		Route::get('plugins/anuncios/modulos/{id}/excluir', array('as'  => 'cms-adverts-locations-delete', 'uses' => 'LocationsAdvertsController@destroy', 'nickname' => "Excluir Local de Banners"));
		Route::get('plugins/anuncios/modulos/{id}/{action}', array('as' => 'cms-adverts-locations-status', 'uses' => 'LocationsAdvertsController@status', 'nickname' => "Status de Local de Banners"));

		Route::get('plugins/anuncios/relatorios', array('as' 				=> 'cms-adverts-reports', 'uses' => 'AdvertsController@index', 'nickname' => "Listar Relatórios de Banners"));
		/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

		/* ~~~~~~~~~~~~ENQUETES~~~~~~~~~~~~~~~~~~~~~~~~~*/
		Route::get('enquetes', array('as'                     		   => 'cms-polls', 'uses' => 'PollsController@index', 'nickname' => "Listar Enquetes"));
		Route::get('enquetes/novo', array('as'                         => 'cms-polls-create', 'uses' => 'PollsController@create', 'nickname' => "Criar Enquetes"));
		Route::post('enquetes/novo', array('as'                        => 'cms-polls-create', 'uses' => 'PollsController@store', 'nickname' => "Criar Enquetes"));
		Route::get('enquetes/{id}', array('as'                         => 'cms-polls-show', 'uses' => 'PollsController@show', 'nickname' => "Visualizar Enquetes"));
		Route::put('enquetes/{id}', array('as'                         => 'cms-polls-update', 'uses' => 'PollsController@update', 'nickname' => "Atualizar Enquetes"));
		Route::get('enquetes/excluir/{id}', array('as'                 => 'cms-polls-delete', 'uses' => 'PollsController@destroy', 'nickname' => "Excluir Enquetes"));
		Route::get('enquetes/status/{id}/{action}', array('as'         => 'cms-polls-status', 'uses' => 'PollsController@status', 'nickname' => "Status de Enquetes"));
		Route::get('enquetes/exibicao/{id}/{action}', array('as'       => 'cms-polls-exibhtion', 'uses' => 'PollsController@exibhtion', 'nickname' => "Exibição de Enquetes"));

		Route::get('enquetes/opcoes/{poll}/', array('as'           			=> 'cms-polls-questions', 'uses' => 'PollsQuestionsController@index', 'nickname' => "Listar Perguntas de Enquetes"));
		Route::get('enquetes/opcoes/{poll}/novo', array('as'                 => 'cms-polls-questions-create', 'uses' => 'PollsQuestionsController@create', 'nickname' => "Criar Perguntas de Enquetes"));
		Route::post('enquetes/opcoes/{poll}/novo', array('as'                => 'cms-polls-questions-create', 'uses' => 'PollsQuestionsController@store', 'nickname' => "Criar Perguntas de Enquetes"));
		Route::get('enquetes/opcoes/{poll}/{id}', array('as'                 => 'cms-polls-questions-show', 'uses' => 'PollsQuestionsController@show', 'nickname' => "Visualizar Perguntas de Enquetes"));
		Route::put('enquetes/opcoes/{poll}/{id}', array('as'                 => 'cms-polls-questions-update', 'uses' => 'PollsQuestionsController@update', 'nickname' => "Atualizar Perguntas de Enquetes"));
		Route::get('enquetes/opcoes/excluir/{poll}/{id}', array('as'         => 'cms-polls-questions-delete', 'uses' => 'PollsQuestionsController@destroy', 'nickname' => "Excluir Perguntas de Enquetes"));

		Route::get('newsletters', array('as'                              => 'cms-newsletters', 'uses' => 'NewslettersController@index', 'nickname' => "Listar Newsletters"));
		Route::get('newsletters/excluir/{id}', array('as'                 => 'cms-newsletters-delete', 'uses' => 'NewslettersController@destroy', 'nickname' => "Excluir Newsletters"));
		Route::get('newsletters/status/{id}/{action}', array('as'         => 'cms-newsletters-status', 'uses' => 'NewslettersController@status', 'nickname' => "Status de Newsletters"));
		Route::get('newsletters/relatorio', array('as' 			  	 	  => 'cms-newsletters-report', 'uses' => 'NewslettersController@report', 'nickname' => "Relatorio de Newsletters"));

		/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/


		Route::get('/banco-de-dados/backup', array('as' => 'cms-db-backup', 'uses' => 'DataBaseController@backup', 'nickname' => "Ver Backup de Banco de Dados"));	
		Route::post('/banco-de-dados/backup', array('as' => 'cms-db-backup-down', 'uses' => 'DataBaseController@down', 'nickname' => "Realizar Backup de Banco de Dados"));

		Route::get('/banco-de-dados/limpeza', array('as' => 'cms-db-clean', 'uses' => 'DataBaseController@clean', 'nickname' => "Ver Limpeza de Banco de Dados"));	
		Route::post('/banco-de-dados/limpeza', array('as' => 'cms-db-clean-action', 'uses' => 'DataBaseController@action', 'nickname' => "Realizar Limpeza de Banco de Dados"));	
	});
});


