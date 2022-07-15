<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'store']);

Route::post('/category', [CategoryController::class, 'store']);

Route::resource('users', UserController::class);

Route::resource('songs', SongController::class);

Route::get('songs/author/{id}', [SongController::class, 'getByAuthor']);

Route::get('/songs/category/{id}', [SongController::class, 'getByCategory']);




Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::get('my-songs', [SongController::class,'mySongs']);

    Route::get('/logout', [AuthController::class,'logout']);

    Route::resource('songs', SongController::class)->only('store', 'update', 'destroy');

});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class,'login']);

Route::post('/category', [CategoryController::class, 'store']);
