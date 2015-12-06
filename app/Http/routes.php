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
Route::get( 'createSeance/{id}', [ 'as' => 'createSeance', 'uses' => 'SeanceController@create' ] );
Route::post( 'createSeance/{id}', [ 'as' => 'createSeance', 'uses' => 'SeanceController@store' ] );

Route::get( 'courses/{id}/seances', [ 'as' => 'getSeancesByCourse', 'uses' => 'SeanceController@getByCourse' ] );

Route::get( 'viewSeance/{id}', [ 'as' => 'viewSeance', 'uses' => 'SeanceController@view' ] );
Route::get( 'delete/{id}/{course}', [ 'as' => 'delete', 'uses' => 'SeanceController@delete' ] );
Route::get( 'deleteAll/{course}', [ 'as' => 'deleteAll', 'uses' => 'SeanceController@deleteAll' ] );

Route::get( 'updateSeance/{id}', [ 'as' => 'updateSeance', 'uses' => 'SeanceController@edit' ] );
Route::post( 'updateSeance/{id}', [ 'as' => 'updateSeance', 'uses' => 'SeanceController@update' ] );


// Gestion des cours:
Route::get( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CourseController@create' ] );
Route::post( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CourseController@store' ] );

Route::get( 'viewCourse/{id}/{action}', [ 'as' => 'viewCourse', 'uses' => 'CourseController@view' ] );

Route::get( 'deleteCourse/{id}', [ 'as' => 'deleteCourse', 'uses' => 'CourseController@delete' ] );

Route::get( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CourseController@edit' ] );
Route::post( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CourseController@update' ] );

// Ajouter cours (étudiant)
Route::get( 'addCourse/{id}', [ 'as' => 'addCourse', 'uses' => 'CourseController@addCourse' ] );
Route::get( 'removeCourse/{id}', [ 'as' => 'removeCourse', 'uses' => 'CourseController@removeCourse' ] );
Route::get( 'removeStudentFromCourse/{id_course}/{id_user}', [ 'as' => 'removeStudentFromCourse', 'uses' => 'CourseController@removeStudentFromCourse' ] );
Route::get( 'updateCourse/{id}', [ 'as' => 'updateCourse', 'uses' => 'CourseController@edit' ] );

Route::get( 'indexCourse', [ 'as' => 'indexCourse', 'uses' => 'CourseController@index' ] );
Route::get( 'searchCourse', [ 'as' => 'searchCourse', 'uses' => 'CourseController@searchCourse' ] );

// TESTS
Route::get( 'createWork/{id?}/{info?}', [ 'as' => 'createWork', 'uses' => 'WorkController@create' ] );
Route::post( 'createWork/{id?}/{info?}', [ 'as' => 'createWork', 'uses' => 'WorkController@store' ] );
Route::get( 'deleteTest/{id}', [ 'as' => 'deleteTest', 'uses' => 'TestController@delete' ] );
Route::get( 'updateTest/{id}', [ 'as' => 'updateTest', 'uses' => 'TestController@edit' ] );
Route::post( 'updateTest/{id}', [ 'as' => 'updateTest', 'uses' => 'TestController@update' ] );

Route::get( 'createTest/{id?}/{info?}', [ 'as' => 'createTest', 'uses' => 'TestController@create' ] );
Route::post( 'createTest/{id?}/{info?}', [ 'as' => 'createTest', 'uses' => 'TestController@store' ] );
Route::get( 'addNews', [ 'as' => 'addNews', 'uses' => 'CourseController@addNews' ] );


// Redirect to registerS or registerT page...
Route::get( 'registerStudent', [ 'as' => 'registerStudent', 'uses' => 'PageController@registerStudent' ] );
Route::get( 'registerTeacher', [ 'as' => 'registerTeacher', 'uses' => 'PageController@registerTeacher' ] );

// Test route
Route::get( 'createTest', [ 'as' => 'createTest', 'uses' => 'PageController@createTest' ] );

// work route
Route::get( 'createWork', [ 'as' => 'createWork', 'uses' => 'PageController@createWork' ] );

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
