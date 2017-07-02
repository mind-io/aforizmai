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
	'uses' => 'PagesController@getCategoryIndex',
	'as' => 'categories.index'
]);

Route::get('/kategorijos/{slug}', [
	'uses' => 'PagesController@getCategoryName',
	'as' => 'categories.name'
]);

Route::get('/autoriai', [ 
	'uses' => 'PagesController@getAuthorIndex',
	'as' => 'authors.index'
]);

Route::get('/autoriai/{slug}', [ 
	'uses' => 'PagesController@getAuthorName',
	'as' => 'authors.name'
]);

Route::post('/autoriai', [ 
	'uses' => 'PagesController@postAuthorSelect',
	'as' => 'authors.select'
]);

Route::get('topautoriai', [
	'uses' => 'AuthorController@getPopularAuthors',
	'as' => 'authors.popular'
]);

Route::post('/like', [
	'uses' => 'UserController@postLikeQuote',
	'as' => 'like.quote',
	'middleware' => 'auth'
]);



// Routes for NoptApproved quotes (Submissions)

Route::get('/naujas-aforizmas', [
	'uses' => 'QuoteController@getSubmitForm',
	'as' => 'submissions.create'
]);

Route::group(['prefix' => '/nauji-aforizmai'], function() {


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
