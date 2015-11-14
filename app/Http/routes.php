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

Route::get('/', 'MainController@index');

// authentication
\Route::get('/auth', ['as' => 'auth', 'use' => 'MainController@redirectToGitHub']);

// for ajax
Route::post('/check/git',     'AjaxController@checkGitHubName');
Route::post('/register/user', 'AjaxController@registerUser');
