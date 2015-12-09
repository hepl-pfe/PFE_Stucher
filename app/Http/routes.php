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

Route::get( '/', [ 'as' => 'home', 'uses' => 'CourseController@index' ] );

Route::get( 'a-propos', [ 'as' => 'about', 'uses' => 'PageController@about' ] );

Route::get( 'updateProfil', [ 'as' => 'updateProfil', 'uses' => 'PageController@editProfil' ] );
Route::post( 'updateProfil', [ 'as' => 'updateProfil', 'uses' => 'PageController@updateProfil' ] );


Route::get( 'deleteProfil', [ 'as' => 'deleteProfil', 'uses' => 'PageController@deleteProfil' ] );

Route::get( 'notification', [ 'as' => 'notification', 'uses' => 'PageController@notification' ] );
Route::get( 'message', [ 'as' => 'message', 'uses' => 'PageController@message' ] );
Route::get( 'newMessage', [ 'as' => 'newMessage', 'uses' => 'PageController@newMessage' ] );
Route::get( 'repMessage', [ 'as' => 'repMessage', 'uses' => 'PageController@repMessage' ] );
Route::get( 'planning', [ 'as' => 'planning', 'uses' => 'PageController@planning' ] );


// Gestion des séances de cours:
Route::get( 'createSeance/{id}', [ 'as' => 'createSeance', 'uses' => 'SeanceController@create', 'middleware' => 'isTeacher' ] );
Route::post( 'createSeance/{id}', [ 'as' => 'createSeance', 'uses' => 'SeanceController@store', 'middleware' => 'isTeacher' ] );

Route::get( 'courses/{id}/seances', [ 'as' => 'getSeancesByCourse', 'uses' => 'SeanceController@getByCourse' ] );

Route::get( 'viewSeance/{id}', [ 'as' => 'viewSeance', 'uses' => 'SeanceController@view' ] );
Route::get( 'delete/{id}/{course}', [ 'as' => 'delete', 'uses' => 'SeanceController@delete', 'middleware' => 'isTeacher' ] );
Route::get( 'deleteAll/{course}', [ 'as' => 'deleteAll', 'uses' => 'SeanceController@deleteAll', 'middleware' => 'isTeacher' ] );

Route::get( 'updateSeance/{id}', [ 'as' => 'updateSeance', 'uses' => 'SeanceController@edit', 'middleware' => 'isTeacher' ] );
Route::post( 'updateSeance/{id}', [ 'as' => 'updateSeance', 'uses' => 'SeanceController@update', 'middleware' => 'isTeacher' ] );


// Gestion des cours:
Route::get( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CourseController@create', 'middleware' => 'isTeacher' ] );
Route::post( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CourseController@store', 'middleware' => 'isTeacher' ] );

Route::get( 'viewCourse/{id}/{action}', [ 'as' => 'viewCourse', 'uses' => 'CourseController@view' ] );

Route::get( 'deleteCourse/{id}', [ 'as' => 'deleteCourse', 'uses' => 'CourseController@delete', 'middleware' => 'isTeacher' ] );

Route::get( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CourseController@edit', 'middleware' => 'isTeacher' ] );
Route::post( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CourseController@update', 'middleware' => 'isTeacher' ] );

// Ajouter cours (étudiant)
Route::get( 'addCourse/{id}', [ 'as' => 'addCourse', 'uses' => 'CourseController@addCourse' ] );
Route::get( 'addCourse/{id}', [ 'as' => 'addCourse', 'uses' => 'CourseController@addCourse' ] );
Route::get( 'removeCourse/{id}', [ 'as' => 'removeCourse', 'uses' => 'CourseController@removeCourse' ] );
Route::post( 'getByToken', [ 'as' => 'getByToken', 'uses' => 'CourseController@getByToken' ] );
Route::get( 'acceptStudent/{id_course}/{id_user}', [ 'as' => 'acceptStudent', 'uses' => 'CourseController@acceptStudent', 'middleware' => 'isTeacher' ] );
Route::get( 'removeStudentFromCourse/{id_course}/{id_user}', [ 'as' => 'removeStudentFromCourse', 'uses' => 'CourseController@removeStudentFromCourse', 'middleware' => 'isTeacher' ] );

Route::get( 'indexCourse', [ 'as' => 'indexCourse', 'uses' => 'CourseController@index' ] );
Route::get( 'searchCourse', [ 'as' => 'searchCourse', 'uses' => 'CourseController@searchCourse' ] );

// TESTS
Route::get( 'createWork/{id?}/{info?}', [ 'as' => 'createWork', 'uses' => 'WorkController@create', 'middleware' => 'isTeacher' ] );
Route::post( 'createWork/{id?}/{info?}', [ 'as' => 'createWork', 'uses' => 'WorkController@store', 'middleware' => 'isTeacher' ] );
Route::get( 'deleteTest/{id}', [ 'as' => 'deleteTest', 'uses' => 'TestController@delete', 'middleware' => 'isTeacher' ] );
Route::get( 'updateTest/{id}', [ 'as' => 'updateTest', 'uses' => 'TestController@edit', 'middleware' => 'isTeacher' ] );
Route::post( 'updateTest/{id}', [ 'as' => 'updateTest', 'uses' => 'TestController@update', 'middleware' => 'isTeacher' ] );

// HOMEWORKS
Route::get( 'createTest/{id?}/{info?}', [ 'as' => 'createTest', 'uses' => 'TestController@create', 'middleware' => 'isTeacher' ] );
Route::post( 'createTest/{id?}/{info?}', [ 'as' => 'createTest', 'uses' => 'TestController@store', 'middleware' => 'isTeacher' ] );
Route::get( 'deleteWork/{id}', [ 'as' => 'deleteWork', 'uses' => 'WorkController@delete', 'middleware' => 'isTeacher' ] );
Route::get( 'updateWork/{id}', [ 'as' => 'updateWork', 'uses' => 'WorkController@edit', 'middleware' => 'isTeacher' ] );
Route::post( 'updateWork/{id}', [ 'as' => 'updateWork', 'uses' => 'WorkController@update', 'middleware' => 'isTeacher' ] );


// NOTIFICATIONS
Route::get( 'addNews', [ 'as' => 'addNews', 'uses' => 'CourseController@addNews' ] );
Route::get( 'getTeacher/{id}', [ 'as' => 'getTeacher', 'uses' => 'NotificationController@getTeacher', 'middleware' => 'isTeacher' ] );


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
