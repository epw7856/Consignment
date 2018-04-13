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

Route::get('/', function () {

	if (Auth::check()){
		return Redirect::to('/home');

	}
	else{
		return view('/auth/login');
	}

});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware(['adminhome']);
Route::get('/home-admin', 'HomeController@adminindex')->middleware(['admincheck']);
Route::post('/insert', 'UserController@insert')->middleware(['admincheck']);
Route::post('/edit/{itemid}', 'UserController@edit')->middleware(['admincheck']);
Route::get('/update/{itemid}', 'UserController@update')->middleware(['admincheck']);
Route::get('/delete/{itemid}', 'UserController@delete')->middleware(['admincheck']);
Route::get('/manage-clients', 'ClientController@view')->middleware(['admincheck']);
Route::post('/edit-client', 'ClientController@edit')->middleware(['admincheck'])->name('client.data');