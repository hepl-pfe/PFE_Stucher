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

Route::get( 'a-propos', [ 'as' => 'about', 'uses' => 'PageController@about', 'middleware' => 'auth' ] );

Route::get( 'updateProfil', [ 'as' => 'updateProfil', 'uses' => 'PageController@editProfil', 'middleware' => 'auth' ] );
Route::post( 'updateProfil', [ 'as' => 'updateProfil', 'uses' => 'PageController@updateProfil', 'middleware' => 'auth' ] );


Route::get( 'deleteProfil', [ 'as' => 'deleteProfil', 'uses' => 'PageController@deleteProfil', 'middleware' => 'auth' ] );

Route::get( 'notification', [ 'as' => 'notification', 'uses' => 'NotificationController@index', 'middleware' => 'auth' ] );
Route::get( 'message', [ 'as' => 'message', 'uses' => 'PageController@message', 'middleware' => 'auth' ] );
Route::get( 'newMessage', [ 'as' => 'newMessage', 'uses' => 'PageController@newMessage', 'middleware' => 'auth' ] );
Route::get( 'repMessage', [ 'as' => 'repMessage', 'uses' => 'PageController@repMessage', 'middleware' => 'auth' ] );
Route::get( 'planning', [ 'as' => 'planning', 'uses' => 'CalendarController@view', 'middleware' => 'auth' ] );


// Gestion des séances de cours:
Route::get( 'createSeance/{id}', [ 'as' => 'createSeance', 'uses' => 'SeanceController@create', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'createSeance/{id}', [ 'as' => 'createSeance', 'uses' => 'SeanceController@store', 'middleware' => ['auth', 'isTeacher'] ] );

Route::get( 'courses/{id}/seances', [ 'as' => 'getSeancesByCourse', 'uses' => 'SeanceController@getByCourse', 'middleware' => 'auth' ] );

Route::get( 'viewSeance/{id}', [ 'as' => 'viewSeance', 'uses' => 'SeanceController@view', 'middleware' => 'auth' ] );
Route::get( 'delete/{id}/{course}', [ 'as' => 'delete', 'uses' => 'SeanceController@delete', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'deleteAll/{course}', [ 'as' => 'deleteAll', 'uses' => 'SeanceController@deleteAll', 'middleware' => ['auth', 'isTeacher'] ] );

Route::get( 'updateSeance/{id}', [ 'as' => 'updateSeance', 'uses' => 'SeanceController@edit', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'updateSeance/{id}', [ 'as' => 'updateSeance', 'uses' => 'SeanceController@update', 'middleware' => ['auth', 'isTeacher'] ] );


// Gestion des cours:
Route::get( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CourseController@create', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CourseController@store', 'middleware' => ['auth', 'isTeacher'] ] );

Route::get( 'viewCourse/{id}/{action}', [ 'as' => 'viewCourse', 'uses' => 'CourseController@view', 'middleware' => 'auth' ] );

Route::get( 'deleteCourse/{id}', [ 'as' => 'deleteCourse', 'uses' => 'CourseController@delete', 'middleware' => ['auth', 'isTeacher'] ] );

Route::get( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CourseController@edit', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CourseController@update', 'middleware' => ['auth', 'isTeacher'] ] );

// Ajouter cours (étudiant)
Route::get( 'addCourse/{id}', [ 'as' => 'addCourse', 'uses' => 'CourseController@addCourse', 'middleware' => 'auth' ] );
Route::get( 'addCourse/{id}', [ 'as' => 'addCourse', 'uses' => 'CourseController@addCourse', 'middleware' => 'auth' ] );
Route::get( 'removeCourse/{id}', [ 'as' => 'removeCourse', 'uses' => 'CourseController@removeCourse', 'middleware' => 'auth' ] );
Route::post( 'getByToken', [ 'as' => 'getByToken', 'uses' => 'CourseController@getByToken', 'middleware' => 'auth' ] );
Route::get( 'acceptStudent/{id_course}/{id_user}', [ 'as' => 'acceptStudent', 'uses' => 'CourseController@acceptStudent', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'removeStudentFromCourse/{id_course}/{id_user}', [ 'as' => 'removeStudentFromCourse', 'uses' => 'CourseController@removeStudentFromCourse', 'middleware' => ['auth', 'isTeacher'] ] );

Route::get( 'indexCourse', [ 'as' => 'indexCourse', 'uses' => 'CourseController@index', 'middleware' => 'auth' ] );
Route::get( 'searchCourse', [ 'as' => 'searchCourse', 'uses' => 'CourseController@searchCourse', 'middleware' => 'auth' ] );

// TESTS
Route::get( 'createWork/{id?}/{info?}', [ 'as' => 'createWork', 'uses' => 'WorkController@create', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'createWork/{id?}/{info?}', [ 'as' => 'createWork', 'uses' => 'WorkController@store', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'deleteTest/{id}', [ 'as' => 'deleteTest', 'uses' => 'TestController@delete', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'updateTest/{id}', [ 'as' => 'updateTest', 'uses' => 'TestController@edit', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'updateTest/{id}', [ 'as' => 'updateTest', 'uses' => 'TestController@update', 'middleware' => ['auth', 'isTeacher'] ] );

// HOMEWORKS
Route::get( 'createTest/{id?}/{info?}', [ 'as' => 'createTest', 'uses' => 'TestController@create', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'createTest/{id?}/{info?}', [ 'as' => 'createTest', 'uses' => 'TestController@store', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'deleteWork/{id}', [ 'as' => 'deleteWork', 'uses' => 'WorkController@delete', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'updateWork/{id}', [ 'as' => 'updateWork', 'uses' => 'WorkController@edit', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'updateWork/{id}', [ 'as' => 'updateWork', 'uses' => 'WorkController@update', 'middleware' => ['auth', 'isTeacher'] ] );


// NOTIFICATIONS
Route::get( 'addNews', [ 'as' => 'addNews', 'uses' => 'CourseController@addNews', 'middleware' => 'auth' ] );
Route::get( 'getTeacher/{id}', [ 'as' => 'getTeacher', 'uses' => 'NotificationController@getTeacher', 'middleware' => ['auth', 'isTeacher'] ] );


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
