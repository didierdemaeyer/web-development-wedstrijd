<?php

Route::group(['middelware' => 'web'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    // Auth
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);

    // Entries
    Route::get('entries/popular', ['as' => 'entries.popular', 'uses' => 'EntriesController@getPopularEntries']);
    Route::get('entries/latest', ['as' => 'entries.latest', 'uses' => 'EntriesController@getLatestEntries']);
    Route::get('entries/oldest', ['as' => 'entries.oldest', 'uses' => 'EntriesController@getOldestEntries']);
    Route::get('entries/{id}', ['as' => 'entries.show', 'uses' => 'EntriesController@show']);
    Route::get('archived-entries/{period}', ['as' => 'entries.archived', 'uses' => 'EntriesController@getArchivedEntries']);

    // Participate
    Route::get('participate', ['as' => 'participate', 'uses' => 'ParticipationController@getUploadPhoto']);
    Route::post('participate', ['as' => 'participate.post', 'uses' => 'ParticipationController@postUploadPhoto']);
    Route::get('participate/complete-information', ['as' => 'participate.complete-info', 'uses' => 'ParticipationController@getCompleteInfo']);
    Route::post('participate/complete-information', ['as' => 'participate.complete-info.post', 'uses' => 'ParticipationController@postCompleteInfo']);
    Route::get('participate/thank-you', ['as' => 'participate.thank-you', 'uses' => 'ParticipationController@thankYou']);

    /*
     * Only for guests
     */
    Route::group(['middleware' => 'guest'], function () {
        // Auth
        Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
        Route::post('login', ['as' => 'auth.login.post', 'uses' => 'AuthController@postLogin']);
        Route::get('register', ['as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
        Route::post('register', ['as' => 'auth.register.post', 'uses' => 'AuthController@postRegister']);

        // Socialite oAuth routes
        Route::get('social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'SocialAuthController@redirect']);
        Route::get('social/callback/{provider}', ['as' => 'social.callback', 'uses' => 'SocialAuthController@callback']);
    });

    /*
     * Only for logged in users
     */
    Route::group(['middleware' => 'auth'], function () {
        // (Profile)
        Route::get('my-entries/{period}', ['as' => 'profile.entries', 'uses' => 'ProfileController@getMyEntries']);
        Route::get('my-likes/{period}', ['as' => 'profile.likes', 'uses' => 'ProfileController@getMyLikes']);

        // Settings
        Route::get('settings', ['as' => 'settings', 'uses' => 'SettingsController@getSettings']);
        Route::post('settings/personal-information', ['as' => 'settings.information.post', 'uses' => 'SettingsController@updatePersonalInformation']);
        Route::post('settings/change-password', ['as' => 'settings.password.post', 'uses' => 'SettingsController@changePassword']);

        // Entries
        Route::post('entries/like', ['as' => 'entries.like', 'uses' => 'EntriesController@likePhoto']);
        Route::post('entries/unlike', ['as' => 'entries.unlike', 'uses' => 'EntriesController@unlikePhoto']);
    });

    /*
     * Only for admins
     */
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('admin/entries/export', ['as' => 'admin.entries.export-all', 'uses' => 'AdminController@exportAll']);
        Route::get('admin/entries/{period}/export', ['as' => 'admin.entries.export-period', 'uses' => 'AdminController@exportPeriod']);
        Route::get('admin/entries/{period}', ['as' => 'admin.entries', 'uses' => 'AdminController@getEntries']);
        Route::post('admin/delete-photo/{id}', ['as' => 'admin.delete-photo', 'uses' => 'AdminController@deletePhoto']);
        Route::post('admin/disqualify-user/{id}', ['as' => 'admin.disqualify-user', 'uses' => 'AdminController@disqualifyUser']);
    });
});
