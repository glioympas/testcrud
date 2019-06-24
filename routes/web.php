<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'UserController@index')->name('home');
Route::patch('/home/update', 'UserController@update')->name('update_profil');


//Administrator Routes
Route::group(['prefix' => 'admin' , 'middleware' => ['auth' , 'admin']], function(){

	Route::get('/', 'AdminController@index')->name('admin.index');

	//Customers CRUD
	Route::resource('/customers', 'AdminUsersController')->except('show', 'create', 'edit'); //I remove these actions because requests will be via AJAX

});