<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/', array('as' => 'home', 'uses' => 'HomeController@index'));


Route::get('auth/login',   array('as' => 'auth.login',       'uses' => 'AuthController@getLogin'));
Route::post('auth/login',  array('as' => 'auth.login.post',  'uses' => 'AuthController@postLogin'));
Route::get('auth/register',  array('as' => 'auth.register',  'uses' => 'AuthController@getRegister'));
Route::post('auth/register',  array('as' => 'auth.register.post',  'uses' => 'AuthController@postRegister'));
Route::get('auth/logout',  array('as' => 'auth.logout',      'uses' => 'AuthController@getLogout'));


Route::group(array('before' => 'auth'), function()
{
    
	Route::controller('user', 'UserController');
	Route::controller('i', 'IController');
    Route::controller('project', 'ProjectController');
    Route::resource('financings', 'FinancingController');
    Route::controller('x', 'XController');
});