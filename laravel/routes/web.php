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
    return view('welcome');
});

// Get: URL/URI
Route::get('helloworld', function() {
	return dd('Hola Mundo Laravel');
});
// Resource: Crea Automaticamente todas la rutas
// Route::resource('Article', 'ArticleController');


//Imports
Route::get('import/view/users', 'UserController@importExportView');
Route::post('import/excel/users', 'UserController@import')->name('import/excel/users');

// Reports Export
Route::get('generate/pdf/users', 'UserController@pdf');
Route::get('generate/excel/users', 'UserController@excel');

Route::get('generate/pdf/categories', 'CatergoyController@pdf');
Route::get('generate/excel/categories', 'CatergoyController@excel');

Route::get('generate/pdf/articles', 'ArticleController@pdf');
Route::get('generate/excel/articles', 'ArticleController@excel');



// Any: Cualquier solicitud (get/post/put/delete)
Route::any('show/articles', function() {
	$arts = App\Article::all();
	return dd($arts);
});

// View: Vista
Route::view('show/users', '.showusers', ['users' => App\User::all()]);

// Con Parámetro
Route::get('show/user/{id}', function($id) {
	$user = App\User::find($id);
	dd($user);
});



Auth::routes();

Route::group(['middleware' => 'admin'], function() {
	//Resources
	Route::resource('users', 'UserController');
	Route::resource('categories', 'CatergoyController');
	Route::resource('articles', 'ArticleController');
	Route::resource('welcome', 'WelcomeController');
});

Route::post('loadcat', 'WelcomeController@loadcat');

Route::get('home', 'HomeController@index');

Route::get('/', array('uses' => 'WelcomeController@index'));
//Route::get('/{category?}', array('uses' => 'WelcomeController@filter'));
