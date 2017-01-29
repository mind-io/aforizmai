<?php

// Routes for Approved quotes

Route::get('/', [
	'uses' => 'PagesController@getIndex', 
	'as' => 'index'
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

// Routes for NoptApproved quotes (Submissions)
Route::group(['prefix' => '/submissions'], function() {

	Route::get('/create', [
		'uses' => 'QuoteController@getSubmitForm',
		'as' => 'submissions.create'
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

});

	Route::post('/submissions/vote', [
		'uses' => 'QuoteController@postVoteSubmission',
		'as' => 'submissions.vote'
	]);
	
	// Route::post('/submissions/dislike', [
	// 	'uses' => 'QuoteController@postDislikeSubmission',
	// 	'as' => 'submissions.dislike'
	// ]);



// CSV import
Route::get('/csv', [
	'uses' => 'QuoteController@getCSV',
	'as' => 'csv.import'
]);

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function() {

	Route::post('/submissions/create', [
		'uses' => 'QuoteController@submitQuote',
		'as' => 'submissions.store'
	]);


	Route::group(['prefix' => '/user'], function() {

		Route::get('/profile', [
			'uses' => 'UserController@profile',
			'as' => 'user.profile'
		]);

		Route::post('/profile', [
			'uses' => 'UserController@profileUpdate',
			'as' => 'user.profile.update'
		]);

	});
	
});


// Route::get('/admin', 'AdminController@index');
