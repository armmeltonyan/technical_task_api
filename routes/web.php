<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ErrorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/verify/{hash}/{id}',[UserController::class,'verifyEmail']);
Route::get('/404',[ErrorController::class,'notFoundPage']);
Route::get('/verified',[ErrorController::class,'successPage']);
