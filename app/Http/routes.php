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

// authentication
\Route::group(['middleware' => 'guest'], function () {
  \Route::get('/login',          ['as' => 'auth.login',    'uses' => 'AuthController@getLogin']);
  \Route::get('/auth',           ['as' => 'auth',          'uses' => 'AuthController@redirectToGitHub']);
  \Route::get('/oauth/callback', ['as' => 'auth.callback', 'uses' => 'AuthController@handleGitHubRdirect']);
});

// Need login
\Route::group(['middleware' => 'auth'], function () {
    \Route::get('/',       ['as' => 'main',        'uses' => 'MainController@index']);
    \Route::get('/edit',   ['as' => 'main.edit',   'uses' => 'MainController@getEdit']);
    \Route::get('/logout', ['as' => 'main.logout', 'uses' => 'MainController@logout']);

    // for ajax
    \Route::post('/update/phonenumber', ['as' => 'ajax.phone', 'uses' => 'AjaxController@updatePhoneNumber']);
});
