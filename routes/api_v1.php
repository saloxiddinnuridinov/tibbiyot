<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', '\App\Http\Controllers\V1\AuthController@login');
Route::post('register', '\App\Http\Controllers\V1\AuthController@register');
Route::post('verify', '\App\Http\Controllers\V1\AuthController@activateUser');
Route::post('reset-password', '\App\Http\Controllers\V1\AuthController@resetPassword');

Route::post('logout', '\App\Http\Controllers\V1\AuthController@logout');
Route::post('refresh', '\App\Http\Controllers\V1\AuthController@refresh');
Route::post('me', '\App\Http\Controllers\V1\AuthController@me');

Route::get('get-term/{term}/{from}', [App\Http\Controllers\V1\TermController::class, "getTerms"]);

Route::get('get-image/{term_id}/', [App\Http\Controllers\V1\TermController::class, "getImage"]);
Route::get('get-video/{term_id}/', [App\Http\Controllers\V1\TermController::class, "getVideo"]);
Route::get('get-object/{term_id}/', [App\Http\Controllers\V1\TermController::class, "getObject"]);

Route::resource('student', StudentController::class);

Route::resource('category', CategoryController::class);

//userRoute
Route::resource('users', UserController::class);

//Category
Route::resource('category', CategoryController::class);

//imageFile
Route::resource('image-file', ImageFileController::class);

//LessonController
Route::resource('lesson', LessonController::class);

//LessonJoinImageFIle
Route::resource('lesson-join-image-file', LessonJoinImageFileController::class);

//LessonJoinObjectFile
Route::resource('lesson-join-object-file',LessonJoinObjectFileController::class);

//lesson/join/Term
Route::resource('lesson-join-term', LessonJoinTermController::class);

//lesson/join/Video/file
Route::resource('lesson-join-video-file', LessonJoinVideoFileController::class);

//ObjectFile
Route::resource('object-file', ObjectFileController::class);

//Term
Route::resource('term', TermController::class);

//TermJoinImageFile
Route::resource('term-join-image-file', TermJoinImageFileController::class);

//TermJoinObjectFile
Route::resource('term-join-object-file', TermJoinObjectFileController::class);

//TermJoinVideoFile
Route::resource('term-join-video-file', TermJoinVideoFileController::class);

//VideoFile
Route::resource('video-file', VideoFileController::class);