<?php

Route::group(['middelware' => 'web'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    // Auth
    Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'auth.login.post', 'uses' => 'AuthController@postLogin']);
    Route::get('register', ['as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
    Route::post('register', ['as' => 'auth.register.post', 'uses' => 'AuthController@postRegister']);
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);

    // Socialite oAuth routes
    Route::get('social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'SocialAuthController@redirect']);
    Route::get('social/callback/{provider}', ['as' => 'social.callback', 'uses' => 'SocialAuthController@callback']);

    // Settings
    Route::get('settings', ['as' => 'settings', 'uses' => 'SettingsController@getSettings']);
    Route::post('settings', ['as' => 'settings.post', 'uses' => 'SettingsController@postSettings']);

    // Entries
    Route::get('entries/popular', ['as' => 'entries.popular', 'uses' => 'EntriesController@getPopularEntries']);
    Route::get('entries/latest', ['as' => 'entries.latest', 'uses' => 'EntriesController@getLatestEntries']);
    Route::get('entries/oldest', ['as' => 'entries.oldest', 'uses' => 'EntriesController@getOldestEntries']);

    // Participate
    Route::get('participate', ['as' => 'participate', 'uses' => 'ParticipationController@create']);
    Route::post('participate', ['as' => 'participate.store', 'uses' => 'ParticipationController@store']);
});