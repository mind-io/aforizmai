<?php

Route::get('/vue', ['as' => 'vue', 'uses' => 'PagesController@getVue']);

Route::get('/', 						['as' => 'index', 				'uses' => 'PagesController@getIndex']);
Route::get('/nepatvirtinti-aforizmai', 	['as' => 'submissions.index', 	'uses' => 'PagesController@getSubmissionsIndex']);


// Category routes
Route::get('/kategorijos', 			['as' => 'category.index', 'uses' => 'CategoryController@getCategoryIndex']);
Route::get('/kategorijos/{slug}', 	['as' => 'category.name', 'uses' => 'CategoryController@getCategoryName']);
// Category route for Submissions
Route::get('nepatvirtinti-aforizmai/kategorijos/{slug}', ['as' => 'submissions.category.name', 'uses' => 'CategoryController@getSubmissionsCategoryName']);


// Author routes test
Route::get('/autoriai', 		['as' => 'author.index', 'uses' => 'AuthorController@getAuthorIndex']);
Route::get('/autoriai/{slug}',  ['as' => 'author.name', 'uses' => 'AuthorController@getAuthorName']);
// Author route for Submissions
Route::get('nepatvirtinti-aforizmai/autoriai/{slug}', ['as' => 'submissions.author.name', 'uses' => 'AuthorController@getSubmissionsAuthorName']);

// Author selectors
Route::post('/autoriai', 						['as' => 'author.select', 'uses' => 'AuthorController@postAuthorSelect']);
Route::post('nepatvirtinti-aforizmai/autoriai', ['as' => 'submissions.author.select', 'uses' => 'AuthorController@postSubmissionsAuthorSelect']);


// Like route for Approved Quotes
Route::post('/like', ['as' => 'like.quote',	'uses' => 'LikeController@postLikeQuote', 'middleware' => 'auth']);

// Vote route for notApproved Quotes
Route::post('nepatvirtinti-aforizmai/vote', ['as' => 'submissions.vote', 'uses' => 'VoteController@postVoteSubmission',	'middleware' => 'auth']);


// New Quote (Submission)
Route::get('/naujas-aforizmas',  ['as' => 'submissions.create', 'uses' => 'QuoteController@createQuote']);
Route::post('/naujas-aforizmas', ['as' => 'submissions.store', 'uses' => 'QuoteController@storeQuote',	'middleware' => 'auth']);
// Typehead Author autocomplete in the form field
Route::get('/naujas-aforizmas/autocomplete', ['as'=>'submissions.author.autocomplete', 'uses'=>'AuthorController@getAuthorAutocomplete']);



// CSV import
Route::get('/csv', ['as' => 'csv.import', 'uses' => 'QuoteController@getCSV']);


Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');


// User routes
Route::group(['prefix' => '/user', 'middleware' => 'auth'], function() {
	Route::get('/profile', 							['as' => 'user.profile', 'uses' => 'UserController@userProfile']);
	Route::post('/profile', 						['as' => 'user.profile.update', 'uses' => 'UserController@userProfileUpdate']);
	Route::get('/collection', 						['as' => 'user.quote.collection.index', 'uses' => 'UserController@userQuoteCollectionIndex']);
	Route::get('/collection/kategorijos/{slug}', 	['as' => 'user.quote.collection.category', 'uses' => 'UserController@userQuoteCollectionCategory']);
	Route::get('/collection/autoriai/{slug}', 	 	['as' => 'user.quote.collection.author', 'uses' => 'UserController@userQuoteCollectionAuthor']);
	Route::post('/collection/autoriai', 			['as' => 'user.quote.collection.author.select', 'uses' => 'UserController@userQuoteCollectionAuthorSelect']);
});


// Route::get('/admin', 'AdminController@index');
