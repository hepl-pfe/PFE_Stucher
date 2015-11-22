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

Route::get( '/', [ 'as' => 'home', 'uses' => 'CoursesController@index' ] );

Route::get( 'a-propos', [ 'as' => 'about', 'uses' => 'PageController@about' ] );
Route::get( 'notification', [ 'as' => 'notification', 'uses' => 'PageController@notification' ] );
Route::get( 'message', [ 'as' => 'message', 'uses' => 'PageController@message' ] );
Route::get( 'newMessage', [ 'as' => 'newMessage', 'uses' => 'PageController@newMessage' ] );
Route::get( 'repMessage', [ 'as' => 'repMessage', 'uses' => 'PageController@repMessage' ] );
Route::get( 'planning', [ 'as' => 'planning', 'uses' => 'PageController@planning' ] );

Route::get( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CoursesController@create' ] );
Route::post( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CoursesController@store' ] );

Route::get( 'deleteCourse/{id}', [ 'as' => 'deleteCourse', 'uses' => 'CoursesController@delete' ] );

Route::get( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CoursesController@edit' ] );
Route::post( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CoursesController@update' ] );

Route::get( 'indexCourses', [ 'as' => 'indexCourses', 'uses' => 'CoursesController@index' ] );
Route::get( 'addCourses', [ 'as' => 'addCourses', 'uses' => 'CoursesController@add' ] );
Route::get( 'addWork', [ 'as' => 'addWork', 'uses' => 'CoursesController@addWork' ] );
Route::get( 'addTest', [ 'as' => 'addTest', 'uses' => 'CoursesController@addTest' ] );
Route::get( 'addNews', [ 'as' => 'addNews', 'uses' => 'CoursesController@addNews' ] );

Route::get( 'viewCourses/{id}/{action}', [ 'as' => 'viewCourses', 'uses' => 'CoursesController@view' ] );


// Redirect to registerS or registerT page...
Route::get( 'registerStudent', [ 'as' => 'registerStudent', 'uses' => 'PageController@registerStudent' ] );
Route::get( 'registerTeacher', [ 'as' => 'registerTeacher', 'uses' => 'PageController@registerTeacher' ] );


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
