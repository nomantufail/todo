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

Route::get('/', function () {
    return view('welcome');
});

//Tasks routes
Route::get('/tasks',['as'=>'show_tasks', 'uses'=>'TasksController@index']);
Route::get('/task/create','TasksController@create');
Route::post('/task/save',['as'=>'save_task', 'uses'=>'TasksController@store']);
Route::get('/task/{id}/delete','TasksController@destroy');

//customer routes
Route::get('/customers',['as'=>'show_customers', 'uses'=>'CustomersController@Index']);
Route::get('/customers/delete/{id}','CustomersController@destroy');

//default home route
Route::get('/home','TasksController@index');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');