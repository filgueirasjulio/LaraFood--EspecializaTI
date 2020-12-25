<?php

Route::prefix('admin')->namespace('Admin')->group(function() {

    /** routes plans */
    Route::any('/planos/search', 'PlanController@search')->name('plans.search');

    Route::get('/planos', 'PlanController@index')->name('plans.index');
    Route::get('/planos/create', 'PlanController@create')->name('plans.create');
    Route::get('/planos/{url}', 'PlanController@show')->name('plans.show');
    Route::get('/planos/{url}/edit', 'PlanController@edit')->name('plans.edit');

    Route::post('/planos/create', 'PlanController@store')->name('plans.store');
    Route::put('/planos/{url}', 'PlanController@update')->name('plans.update');
    Route::delete('/planos/{url}', 'PlanController@destroy')->name('plans.destroy');

    /** routes details plans */
    Route::any('/planos/{url}/detalhes/search', 'DetailPlanController@search')->name('plans.details.search');

    Route::get('/planos/{url}/detalhes/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::get('/planos/{url}/detalhes', 'DetailPlanController@index')->name('details.plan.index');
    Route::get('/planos/{url}/detalhes/{idDetalhe}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
   
    Route::post('/planos/{url}/detalhes', 'DetailPlanController@store')->name('details.plan.store');       
    Route::put('/planos/{url}/detalhes/{idDetalhe}', 'DetailPlanController@update')->name('details.plan.update'); 
    Route::delete('/planos/{url}/detalhes/{idDetalhe}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    
    /** routes profiles */
    Route::any('/perfis/search', 'ACL\ProfileController@search')->name('profiles.search');

    Route::get('/perfis','ACL\ProfileController@index')->name('profiles.index');
    Route::get('/perfis/create', 'ACL\ProfileController@create')->name('profiles.create');
    Route::get('/perfis/{id}', 'ACL\ProfileController@show')->name('profiles.show');
    Route::get('/perfis/{id}/edit', 'ACL\ProfileController@edit')->name('profiles.edit');
    Route::get('/perfis/{id}/permissoes', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');

    Route::post('/perfis/create', 'ACL\ProfileController@store')->name('profiles.store');
    Route::put('/perfis/{id}', 'ACL\ProfileController@update')->name('profiles.update');
    Route::delete('/perfis/{id}', 'ACL\ProfileController@destroy')->name('profiles.destroy');

    /** routes permissions */
    Route::any('/permissoes/search', 'ACL\PermissionController@search')->name('permissions.search');

    Route::get('/permissoes', 'ACL\PermissionController@index')->name('permissions.index');
    Route::get('/permissoes/create', 'ACL\PermissionController@create')->name('permissions.create');
    Route::get('/permissoes/{id}', 'ACL\PermissionController@show')->name('permissions.show');
    Route::get('/permissoes/{id}/edit', 'ACL\PermissionController@edit')->name('permissions.edit');

    Route::post('/permissoes/create', 'ACL\PermissionController@store')->name('permissions.store');
    Route::put('/permissoes/{id}', 'ACL\PermissionController@update')->name('permissions.update');
    Route::delete('/permissoes/{id}', 'ACL\PermissionController@destroy')->name('permissions.destroy');

});

/** home dashboard */
Route::get('/', function () {
    return view('welcome');
});
