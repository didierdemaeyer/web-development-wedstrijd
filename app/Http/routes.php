<?php

Route::group(['middelware' => 'web'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    // Auth
    Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'auth.login.post', 'uses' => 'AuthController@postLogin']);
    Route::get('sign-up', ['as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
    Route::post('sign-up', ['as' => 'auth.register.post', 'uses' => 'AuthController@postRegister']);

    // Entries
    Route::get('entries', ['as' => 'entries', 'uses' => 'EntriesController@index']);
    Route::get('entries/popular', ['as' => 'entries.popular', 'uses' => 'EntriesController@getPopularEntries']);
    Route::get('entries/latest', ['as' => 'entries.latest', 'uses' => 'EntriesController@getLatestEntries']);
    Route::get('entries/oldest', ['as' => 'entries.oldest', 'uses' => 'EntriesController@getOldestEntries']);

    // Participate
    Route::get('participate', ['as' => 'participate', 'uses' => 'ParticipationController@create']);
    Route::post('participate', ['as' => 'participate.store', 'uses' => 'ParticipationController@store']);
});