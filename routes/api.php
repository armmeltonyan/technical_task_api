<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
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


Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('login',[UserController::class,'login'])->name('login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/profile', [UserController::class,'getProfile']);
    Route::post('/subscribe',[UserController::class,'subscribeToUser']);

    Route::group(['prefix' => 'news'], function() {
        Route::post('/store',[NewsController::class,'store']);
        Route::get('/show',[NewsController::class,'getNews']);
        Route::get('/show/commented',[NewsController::class,'getMoreCommentedNews']);
        
    });

    Route::group(['prefix' => 'comments'], function() {
        Route::post('/store',[CommentController::class,'store']);
        Route::post('/answers/store',[CommentController::class,'storeAnswer']);
    });

});