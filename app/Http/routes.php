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

Route::get( 'user/about', [ 'as' => 'about', 'uses' => 'PageController@about', 'middleware' => 'auth' ] );
Route::get( 'user/{id}', [ 'as' => 'viewUser', 'uses' => 'PageController@viewUser', 'middleware' => 'auth' ] );

Route::get( 'updateProfil', [ 'as' => 'updateProfil', 'uses' => 'PageController@editProfil', 'middleware' => 'auth' ] );
Route::post( 'updateProfil', [ 'as' => 'updateProfil', 'uses' => 'PageController@updateProfil', 'middleware' => 'auth' ] );

// Theme color
Route::get( 'changeColor', [ 'as' => 'changeColor', 'uses' => 'PageController@changeColor', 'middleware' => 'auth' ] );
Route::get( 'updateColor/{number}', [ 'as' => 'updateColor', 'uses' => 'PageController@updateColor', 'middleware' => 'auth' ] );

// Update password
Route::get( 'updatePassword', [ 'as' => 'updatePassword', 'uses' => 'PageController@editPassword', 'middleware' => 'auth' ] );
Route::post( 'updatePassword', [ 'as' => 'updatePassword', 'uses' => 'PageController@updatePassword', 'middleware' => 'auth' ] );



Route::get( 'profil/delete', [ 'as' => 'deleteProfil', 'uses' => 'PageController@deleteProfil', 'middleware' => 'auth' ] );

Route::get( 'notification/all', [ 'as' => 'notification', 'uses' => 'NotificationController@index', 'middleware' => 'auth' ] );
Route::get( 'message/all', [ 'as' => 'message', 'uses' => 'PageController@message', 'middleware' => 'auth' ] );
Route::get( 'message/new', [ 'as' => 'newMessage', 'uses' => 'PageController@newMessage', 'middleware' => 'auth' ] );
Route::get( 'message/re', [ 'as' => 'repMessage', 'uses' => 'PageController@repMessage', 'middleware' => 'auth' ] );
Route::get( 'planning/view', [ 'as' => 'planning', 'uses' => 'CalendarController@view', 'middleware' => 'auth' ] );

Route::get( 'course/{id}/users', [ 'as' => 'courseUser', 'uses' => 'CourseController@indexCourseUsers', 'middleware' => ['auth', 'isTheTeacher'] ] );
Route::get( 'indexUsers', [ 'as' => 'indexUsers', 'uses' => 'CourseController@indexUserUsers', 'middleware' => 'auth' ] );


// Gestion des séances de cours:
Route::get( 'course/{id}/seance', [ 'as' => 'createSeance', 'uses' => 'SeanceController@create', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );
Route::post( 'course/{id}/seance', [ 'as' => 'createSeance', 'uses' => 'SeanceController@store', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );

Route::get( 'courses/{id}/seances', [ 'as' => 'getSeancesByCourse', 'uses' => 'SeanceController@getByCourse', 'middleware' => 'auth' ] );

Route::get( 'seance/{id}/view', [ 'as' => 'viewSeance', 'uses' => 'SeanceController@view', 'middleware' => ['auth'] ] );
Route::get( 'seance/{id}/delete', [ 'as' => 'deleteSeance', 'uses' => 'SeanceController@delete', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );
Route::get( 'course/{id}/seance/delete', [ 'as' => 'deleteAll', 'uses' => 'SeanceController@deleteAll', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );

Route::get( 'seance/{id}/update', [ 'as' => 'updateSeance', 'uses' => 'SeanceController@edit', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );
Route::post( 'seance/{id}/update', [ 'as' => 'updateSeance', 'uses' => 'SeanceController@update', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );

Route::get( 'course/{id}/seances/history', [ 'as' => 'seanceHistory', 'uses' => 'SeanceController@seanceHistory', 'middleware' => 'auth' ] );


// Gestion des cours:
Route::get( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CourseController@create', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'createCourse', [ 'as' => 'createCourse', 'uses' => 'CourseController@store', 'middleware' => ['auth', 'isTeacher'] ] );

Route::get( 'course/{id}/view', [ 'as' => 'viewCourse', 'uses' => 'CourseController@view', 'middleware' => ['auth'] ] );

Route::get( 'course/{id}/delete', [ 'as' => 'deleteCourse', 'uses' => 'CourseController@delete', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );

Route::get( 'course/{id}/update', [ 'as' => 'updateCourse', 'uses' => 'CourseController@edit', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );
Route::post( 'course/{id}/update', [ 'as' => 'updateCourse', 'uses' => 'CourseController@update', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );

// Ajouter cours (étudiant)
Route::get( 'course/{id}/add', [ 'as' => 'addCourse', 'uses' => 'CourseController@addCourse', 'middleware' => 'auth' ] );
Route::get( 'course/wait', [ 'as' => 'waitCourse', 'uses' => 'CourseController@waitCourse', 'middleware' => 'auth' ] );
Route::get( 'course/{id}/remove', [ 'as' => 'removeCourse', 'uses' => 'CourseController@removeCourse', 'middleware' => 'auth' ] );
Route::post( 'getByToken', [ 'as' => 'getByToken', 'uses' => 'CourseController@getByToken', 'middleware' => 'auth' ] );
Route::get( 'searchCourse', [ 'as' => 'searchCourse', 'uses' => 'CourseController@searchCourse', 'middleware' => 'auth' ] );
Route::get( 'course/{id}/user/{id_user}/accept', [ 'as' => 'acceptStudent', 'uses' => 'CourseController@acceptStudent', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );
Route::get( 'course/{id}/user/{id_user}/remove', [ 'as' => 'removeStudentFromCourse', 'uses' => 'CourseController@removeStudentFromCourse', 'middleware' => ['auth', 'isTeacher', 'isTheTeacher'] ] );

// TESTS
Route::get( 'test/{id?}/{info?}/create', [ 'as' => 'createTest', 'uses' => 'TestController@create', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'test/{id?}/{info?}/create', [ 'as' => 'createTest', 'uses' => 'TestController@store', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'test/{id}/delte', [ 'as' => 'deleteTest', 'uses' => 'TestController@delete', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'test/{id}/update', [ 'as' => 'updateTest', 'uses' => 'TestController@edit', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'test/{id}/update', [ 'as' => 'updateTest', 'uses' => 'TestController@update', 'middleware' => ['auth', 'isTeacher'] ] );

// HOMEWORKS
Route::get( 'work/{id?}/{info?}/create', [ 'as' => 'createWork', 'uses' => 'WorkController@create', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'work/{id?}/{info?}/create', [ 'as' => 'createWork', 'uses' => 'WorkController@store', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'work/{id}/delete', [ 'as' => 'deleteWork', 'uses' => 'WorkController@delete', 'middleware' => ['auth', 'isTeacher'] ] );
Route::get( 'work/{id}/update', [ 'as' => 'updateWork', 'uses' => 'WorkController@edit', 'middleware' => ['auth', 'isTeacher'] ] );
Route::post( 'work/{id}/update', [ 'as' => 'updateWork', 'uses' => 'WorkController@update', 'middleware' => ['auth', 'isTeacher'] ] );


// NOTIFICATIONS
Route::get( 'addNews', [ 'as' => 'addNews', 'uses' => 'CourseController@addNews', 'middleware' => 'auth' ] );


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


// profilPicture routes…
Route::get( 'user/picture/update', [ 'as' => 'changePicture', 'uses' => 'PageController@changePicture', 'middleware' => 'auth' ] );
Route::post( 'user/picture/update', [ 'as' => 'changePicture', 'uses' => 'PageController@updatePicture', 'middleware' => 'auth' ] );


// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Comments route
Route::post('comments/create', [ 'as' => 'createComment', 'uses' => 'CommentController@create' ]);
Route::get('comments/delete/{id}', [ 'as' => 'deleteComment', 'uses' => 'CommentController@delete', 'middleware' => ['auth', 'isTheTeacher'] ]);