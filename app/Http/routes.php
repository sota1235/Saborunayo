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

\Route::get('/', 'MainController@index');

// authentication
\Route::get('/auth',           ['as' => 'auth', 'uses' => 'AuthController@redirectToGitHub']);
\Route::get('/oauth/callback', ['as' => 'auth.callback', 'uses' => 'AuthController@handleGitHubRdirect']);

// for ajax
\Route::post('/check/git',     'AjaxController@checkGitHubName');
\Route::post('/register/user', 'AjaxController@registerUser');
