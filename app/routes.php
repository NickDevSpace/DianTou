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
//Route::get('auth/register',  array('as' => 'auth.register',  'uses' => 'AuthController@getRegister'));
//Route::post('auth/register',  array('as' => 'auth.register.post',  'uses' => 'AuthController@postRegister'));
Route::get('auth/logout',  array('as' => 'auth.logout',      'uses' => 'AuthController@getLogout'));

Route::controller('auth', 'AuthController');
Route::controller('x', 'XController');
Route::controller('help', 'HelpController');


Route::group(array('before' => 'auth'), function()
{

	Route::controller('i', 'IController');
    Route::controller('project', 'ProjectController');
	Route::controller('pm', 'PrivateMessageController');
    Route::controller('sm', 'SystemMessageController');
	Route::controller('sub', 'SubscriptionController');
    Route::controller('app', 'AppointmentController');
});

Route::group(array('before' => 'auth.admin', 'prefix' => 'admin'), function()
{
    Route::controller('index', 'AdminIndexController');
    Route::controller('user', 'AdminUserController');
    Route::controller('audit', 'AdminAuditController');
    Route::controller('sm', 'AdminSystemMessageController');
    Route::controller('project', 'AdminProjectController');
});


//一些全局错误页面
Route::get('accessDenied.html', array('as' => 'error-401', function()
{
    return View::make('error.401');
}));

Route::get('internalError.html', array('as' => 'error-502', function()
{
    return View::make('error.502');
}));