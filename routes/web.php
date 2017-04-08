<?php

// Routes for Approved quotes

Route::get('/', [
	'uses' => 'PagesController@getIndex', 
	'as' => 'index'
]);

Route::get('/vue', [
	'uses' => 'PagesController@getVue',
	'as' => 'vue'
]);

Route::get('/kategorijos', [
	'uses' => 'PagesController@getCategoriesIndex',
	'as' => 'categories.index'
]);

Route::get('/kategorijos/{slug}', [
	'uses' => 'PagesController@getCategoriesName',
	'as' => 'categories.name'
]);


Route::get('/autoriai', [ 
	'uses' => 'PagesController@getAuthorsIndex',
	'as' => 'authors.index'
]);

Route::get('/autoriai/{slug}', [ 
	'uses' => 'PagesController@getAuthorsName',
	'as' => 'authors.name'
]);

Route::post('/autoriai', [ 
	'uses' => 'PagesController@postAuthorsSelect',
	'as' => 'authors.select'
]);

Route::post('/like', [
	'uses' => 'UserController@postLikeQuote',
	'as' => 'like.quote',
	'middleware' => 'auth'
]);



// Routes for NoptApproved quotes (Submissions)
Route::group(['prefix' => '/submissions'], function() {

	Route::get('/create', [
		'uses' => 'QuoteController@getSubmitForm',
		'as' => 'submissions.create'
	]);

	Route::post('/create', [
		'uses' => 'QuoteController@submitQuote',
		'as' => 'submissions.store',
		'middleware' => 'auth'

	]);


	Route::get('/autocomplete', [
		'uses'=>'QuoteController@getAuthorAutocomplete',
		'as'=>'submissions.authors.autocomplete'
	]);

	Route::get('/', [
		'uses' => 'PagesController@getSubmissionsIndex',
		'as' => 'submissions.index'
	]);

	Route::get('/kategorijos/{slug}', [
		'uses' => 'PagesController@getSubmissionsCategoriesName',
		'as' => 'submissions.categories.name'
	]);

	Route::get('/autoriai/{slug}', [ 
		'uses' => 'PagesController@getSubmissionsAuthorsName',
		'as' => 'submissions.authors.name'
	]);

	Route::post('/autoriai', [ 
		'uses' => 'PagesController@postSubmissionsAuthorsSelect',
		'as' => 'submissions.authors.select'
	]);

	Route::post('/vote', [
		'uses' => 'UserController@postVoteSubmission',
		'as' => 'submissions.vote',
		'middleware' => 'auth'
	]);

});



// CSV import
Route::get('/csv', [
	'uses' => 'QuoteController@getCSV',
	'as' => 'csv.import'
]);

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');


// User routes
Route::group(['prefix' => '/user', 'middleware' => 'auth'], function() {

	Route::get('/profile', [
		'uses' => 'UserController@userProfile',
		'as' => 'user.profile'
	]);

	Route::post('/profile', [
		'uses' => 'UserController@userProfileUpdate',
		'as' => 'user.profile.update'
	]);

	Route::get('/collection', [
		'uses' => 'UserController@userQuoteCollectionIndex',
		'as' => 'user.quote.collection.index'
	]);

	Route::get('/collection/kategorijos/{slug}', [
		'uses' => 'UserController@userQuoteCollectionCategory',
		'as' => 'user.quote.collection.category'
	]);

	Route::get('/collection/autoriai/{slug}', [ 
		'uses' => 'UserController@userQuoteCollectionAuthor',
		'as' => 'user.quote.collection.author'
	]);	

	Route::post('/autoriai', [ 
		'uses' => 'UserController@userQuoteCollectionAuthorSelect',
		'as' => 'user.quote.collection.author.select'
	]);
	
});


// Route::get('/admin', 'AdminController@index');
