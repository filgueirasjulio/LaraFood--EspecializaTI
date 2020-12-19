<?php

//plans routes
Route::any('admin/planos/search', 'Admin\PlanController@search')->name('plans.search');

Route::get('admin/planos', 'Admin\PlanController@index')->name('plans.index');
Route::get('admin/planos/create', 'Admin\PlanController@create')->name('plans.create');
Route::get('admin/planos/{url}', 'Admin\PlanController@show')->name('plans.show');
Route::get('admin/planos/{url}/edit', 'Admin\PlanController@edit')->name('plans.edit');

Route::post('admin/planos/create', 'Admin\PlanController@store')->name('plans.store');
Route::put('admin/planos/{url}', 'Admin\PlanController@update')->name('plans.update');
Route::delete('admin/planos/{url}', 'Admin\PlanController@destroy')->name('plans.destroy');

//plans routes end

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
