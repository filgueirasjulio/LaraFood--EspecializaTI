<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
       ->namespace('Admin')
       ->middleware('auth')
       ->group(function() {

    /** routes users */
    Route::any('/usuarios/busca', 'UserController@search')->name('users.search');

    Route::get('/usuarios','UserController@index')->name('users.index');
    Route::get('/usuario/cadastro', 'UserController@create')->name('users.create');
    Route::get('/usuario/{id}', 'UserController@show')->name('users.show');
    Route::get('/usuario/{id}/edicao', 'UserController@edit')->name('users.edit');

    Route::post('/usuario/cadastro', 'UserController@store')->name('users.store');
    Route::put('/usuario/{id}', 'UserController@update')->name('users.update');
    Route::delete('/usuario/{id}', 'UserController@destroy')->name('users.destroy');

    /** categories */
    Route::any('/categorias/busca', 'CategoryController@search')->name('categories.search');

    Route::get('/categorias','CategoryController@index')->name('categories.index');
    Route::get('/categoria/cadastro', 'CategoryController@create')->name('categories.create');
    Route::get('/categoria/{id}', 'CategoryController@show')->name('categories.show');
    Route::get('/categoria/{id}/edicao', 'CategoryController@edit')->name('categories.edit');

    Route::post('/categoria/cadastro', 'CategoryController@store')->name('categories.store');
    Route::put('/categoria/{id}', 'CategoryController@update')->name('categories.update');
    Route::delete('/categoria/{id}', 'CategoryController@destroy')->name('categories.destroy');

    /** routes plans */
    Route::any('/planos/busca', 'PlanController@search')->name('plans.search');

    Route::get('/planos', 'PlanController@index')->name('plans.index');
    Route::get('/plano/cadastro', 'PlanController@create')->name('plans.create');
    Route::get('/plano/{url}', 'PlanController@show')->name('plans.show');
    Route::get('/plano/{url}/edicao', 'PlanController@edit')->name('plans.edit');

    Route::post('/plano/cadastro', 'PlanController@store')->name('plans.store');
    Route::put('/plano/{url}', 'PlanController@update')->name('plans.update');
    Route::delete('/plano/{url}', 'PlanController@destroy')->name('plans.destroy');

    /** routes details plans */
    Route::any('/planos/{url}/detalhes/busca', 'DetailPlanController@search')->name('plans.details.search');

    Route::get('/plano/{url}/detalhes/cadastro', 'DetailPlanController@create')->name('details.plan.create');
    Route::get('/planos/{url}/detalhes', 'DetailPlanController@index')->name('details.plan.index');
    Route::get('/plano/{url}/detalhes/{idDetalhe}/edicao', 'DetailPlanController@edit')->name('details.plan.edit');
   
    Route::post('/plano/{url}/detalhes', 'DetailPlanController@store')->name('details.plan.store');       
    Route::put('/plano/{url}/detalhes/{idDetalhe}', 'DetailPlanController@update')->name('details.plan.update'); 
    Route::delete('/plano/{url}/detalhes/{idDetalhe}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    
    /** routes profiles */
    Route::any('/perfis/busca', 'ACL\ProfileController@search')->name('profiles.search');

    Route::get('/perfis','ACL\ProfileController@index')->name('profiles.index');
    Route::get('/perfil/cadastro', 'ACL\ProfileController@create')->name('profiles.create');
    Route::get('/perfil/{id}', 'ACL\ProfileController@show')->name('profiles.show');
    Route::get('/perfil/{id}/edicao', 'ACL\ProfileController@edit')->name('profiles.edit');

    Route::post('/perfil/cadastro', 'ACL\ProfileController@store')->name('profiles.store');
    Route::put('/perfil/{id}', 'ACL\ProfileController@update')->name('profiles.update');
    Route::delete('/perfil/{id}', 'ACL\ProfileController@destroy')->name('profiles.destroy');

    /** routes permissions */
    Route::any('/permissoes/busca', 'ACL\PermissionController@search')->name('permissions.search');

    Route::get('/permissoes', 'ACL\PermissionController@index')->name('permissions.index');
    Route::get('/permissao/cadastro', 'ACL\PermissionController@create')->name('permissions.create');
    Route::get('/permissao/{id}', 'ACL\PermissionController@show')->name('permissions.show');
    Route::get('/permissao/{id}/edicao', 'ACL\PermissionController@edit')->name('permissions.edit');

    Route::post('/permissao/cadastro', 'ACL\PermissionController@store')->name('permissions.store');
    Route::put('/permissao/{id}', 'ACL\PermissionController@update')->name('permissions.update');
    Route::delete('/permissao/{id}', 'ACL\PermissionController@destroy')->name('permissions.destroy');

    /** routes profiles X permissions */
    Route::any('/perfil/{id}/permissoes-disponiveis/busca', 'ACL\PermissionProfileController@filterPermissionsAvailable')->name('profiles.permissions.available.search');
    Route::any('/perfil/{id}/permissoes-vinculadas/busca', 'ACL\PermissionProfileController@filterPermissionsLinked')->name('profiles.permissions.search');
    Route::any('/permissao/{id}/perfis-vinculados/busca', 'ACL\PermissionProfileController@filterProfilesLinked')->name('permissions.profiles.search');

    Route::get('/perfil/{id}/permissao/{idPermissao}/desvincular', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');
    Route::get('/perfil/{id}/permissoes/vincular', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('/perfil/{id}/permissoes', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
    Route::get('/permissao/{id}/perfis', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

    Route::post('/perfil/{id}/permissoes/vincular', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
   
    /** routes profiles x plans */
    Route::any('/perfil/{id}/planos-disponiveis/busca', 'ACL\PlanProfileController@filterPlansAvailable')->name('profiles.plans.available.search');
    Route::any('/perfil/{id}/planos-vinculadas/busca', 'ACL\PlanProfileController@filterPlansLinked')->name('profiles.plans.search');
    Route::any('/plano/{id}/perfis-vinculados/busca', 'ACL\PlanProfileController@filterProfilesLinked')->name('plans.profiles.search');

    Route::get('/perfil/{id}/planos', 'ACL\PlanProfileController@plans')->name('profiles.plans');
    Route::get('/perfil/{id}/planos/vincular', 'ACL\PlanProfileController@plansAvailable')->name('profiles.plans.available');
    Route::get('/perfil/{id}/plano/{idPlano}/desvincular', 'ACL\PlanProfileController@detachPlansProfile')->name('profiles.plans.detach');
    Route::get('/plano/{id}/perfis', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
    Route::post('/perfil/{id}/planos/vincular', 'ACL\PlanProfileController@attachPlansProfile')->name('profiles.plans.attach');


    /** routes products  */
    Route::any('/produtos/busca', 'ProductController@search')->name('products.search');

    Route::get('/produtos','ProductController@index')->name('products.index');
    Route::get('/produto/cadastro', 'ProductController@create')->name('products.create');
    Route::get('/produto/{id}', 'ProductController@show')->name('products.show');
    Route::get('/produto/{id}/edicao', 'ProductController@edit')->name('products.edit');

    Route::post('/produto/cadastro', 'ProductController@store')->name('products.store');
    Route::put('/produto/{id}', 'ProductController@update')->name('products.update');
    Route::delete('/produto/{id}', 'ProductController@destroy')->name('products.destroy');

    /** routes tables */
    Route::any('tables/search', 'TableController@search')->name('tables.search');
    Route::resource('tables', 'TableController');

    /** Home */
    Route::get('/', 'PlanController@index')->name('admin.index');
});

/** Site */
Route::get('/plano/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

/**
 * auth routes
 */
Auth::routes();



