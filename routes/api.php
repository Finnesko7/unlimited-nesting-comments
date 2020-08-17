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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', 'PostController@all');
Route::resource('post', 'PostController');
Route::resource('comment', 'CommentController')->only(['store', 'destroy']);

Route::get('comments/{post}', 'CommentController@all');
Route::get('comments/sub/{comment}', 'CommentController@getSubComments');

Route::delete('comment/sub', 'CommentController@destroySub');
