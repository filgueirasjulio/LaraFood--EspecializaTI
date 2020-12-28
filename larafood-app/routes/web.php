<?php

Route::prefix('admin')->namespace('Admin')->group(function() {

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
   
});

/** home dashboard */
Route::get('/', function () {
    return view('welcome');
});
