<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
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

//Public/Unprotected routes
Route::post('/signup', [UserController::class, 'signup']);
Route::post('/signin', [UserController::class, 'signin']);
// Route::resource('todos', TodoController::class);

// Protected Routes. You need a token to be able to do these
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/todos', TodoController::class);    //Call all routes for the Controller implicitly
    Route::get('/todos/search/{description}', [TodoController::class, 'search']); //This rout is not implicitly contained in the controller, so we call it explicitly
    // Route::get('/todos/?status=[status]', [TodoController::class, 'trySomething']);
    Route::put('/changePassword', [UserController::class, 'changePassword']);
    Route::post('/logout', [UserController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
