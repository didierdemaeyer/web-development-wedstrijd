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
    Route::get('entries/{id}', ['as' => 'entries.show', 'uses' => 'EntriesController@show']);

    // Participate
    Route::get('participate', ['as' => 'participate', 'uses' => 'ParticipationController@getUploadPhoto']);
    Route::post('participate', ['as' => 'participate.post', 'uses' => 'ParticipationController@postUploadPhoto']);
    Route::get('participate/complete-information', ['as' => 'participate.complete-info', 'uses' => 'ParticipationController@getCompleteInfo']);
    Route::post('participate/complete-information', ['as' => 'participate.complete-info.post', 'uses' => 'ParticipationController@postCompleteInfo']);
    Route::get('participate/thank-you', ['as' => 'participate.thank-you', 'uses' => 'ParticipationController@thankYou']);

    // (Profile)
    Route::get('my-entries', ['as' => 'profile.entries', 'uses' => 'ProfileController@getMyEntries']);
    Route::get('my-likes', ['as' => 'profile.likes', 'uses' => 'ProfileController@getMyLikes']);
});