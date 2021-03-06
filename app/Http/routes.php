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

Route::get('/', 'WelcomeController@index');

Route::get('/showTab', 'WelcomeController@tab');

Route::get('/home', 'WelcomeController@home');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/**
 * RESTful api
 */
//吉他谱
Route::resource('tab', 'GuitarTabController');

//和弦
Route::resource('chord', 'ChordController');
