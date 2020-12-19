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
});

/** home dashboard */
Route::get('/', function () {
    return view('welcome');
});
