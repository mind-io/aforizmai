<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



// Route::get('/{author?}', [
// 	'uses' => 'QuoteController@getIndex',
// 	'as' => 'index'
// ]);

Route::get('/', [
	'uses' => 'PagesController@getIndex', 
	'as' => 'index'
]);

Route::get('/kategorijos', [
	'uses' => 'PagesController@getCategories',
	'as' => 'categories.index'
]);

Route::get('/kategorijos/{slug}', [
	'uses' => 'PagesController@getCategoryName',
	'as' => 'categories.name'
]);


Route::get('/autoriai', [ 
	'uses' => 'PagesController@getAuthors',
	'as' => 'authors.index'
]);

Route::get('/autoriai/{slug}', [ 
	'uses' => 'PagesController@getAuthorName',
	'as' => 'authors.name'
]);


Route::get('/submissions/create', [
	'uses' => 'QuoteController@getSubmit',
	'as' => 'submissions.create'
]);


Route::auth();

Route::group(['middleware' => 'auth'], function() {

	Route::post('/submissions/create', [
		'uses' => 'QuoteController@submitQuote',
		'as' => 'submissions.store'
	]);



	
});




// Route::get('/admin', 'AdminController@index');
