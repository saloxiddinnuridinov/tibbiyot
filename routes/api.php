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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });

Route::post('login', '\App\Http\Controllers\AuthController@login');
Route::post('register', '\App\Http\Controllers\AuthController@register');
Route::post('verify', '\App\Http\Controllers\AuthController@activateUser');
Route::post('reset-password', '\App\Http\Controllers\AuthController@resetPassword');



Route::group([
    'middleware' => 'auth:api',
], function ($router) {

    Route::post('logout', '\App\Http\Controllers\AuthController@logout');
    Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('me', '\App\Http\Controllers\AuthController@me');
    Route::resource('student',\App\Http\Controllers\StudentController::class);
Route::resource('/category', \App\Http\Controllers\CategoryController::class);

                //user
                Route::resource('users', \App\Http\Controllers\UserController::class);
                
                //Category
                Route::resource('category', \App\Http\Controllers\CategoryController::class);
                
                //imageFile
                Route::resource('image/file', \App\Http\Controllers\ImageFileController::class);
                
                //LessonController
                Route::resource('lesson', \App\Http\Controllers\LessonController::class);
                
                //LessonJoinImageFIle
                Route::resource('lesson/join/image/file', \App\Http\Controllers\LessonJoinImageFileController::class);
                
                //LessonJoinObjectFile
                Route::resource('lesson/join/object/file',\App\Http\Controllers\LessonJoinObjectFileController::class);
                
                //lesson/join/Term
                Route::resource('lesson/join/term', \App\Http\Controllers\LessonJoinTermController::class);
                
                //lesson/join/Video/file
                Route::resource('lesson/join/video/file', \App\Http\Controllers\LessonJoinVideoFileController::class);
                
                //ObjectFile
                Route::resource('object/file', \App\Http\Controllers\ObjectFileController::class);
                
                //Term
                Route::resource('term', \App\Http\Controllers\TermController::class);
                
                //TermJoinImageFile
                Route::resource('term/join/image/file', \App\Http\Controllers\TermJoinImageFileController::class);
                
                //TermJoinObjectFile
                Route::resource('term/join/object/file', \App\Http\Controllers\TermJoinObjectFileController::class);
                
                //TermJoinVideoFile
                Route::resource('term/join/video/file', \App\Http\Controllers\TermJoinVideoFileController::class);
                
                //VideoFile
                Route::resource('video/file', \App\Http\Controllers\VideoFileController::class);

});