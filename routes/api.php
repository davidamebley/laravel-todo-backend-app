<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
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

Route::get('/users', function(){
    return User::all();
});

Route::post('/users', function(){
    return User::create([
        'email' => 'dave@mail.com',
        'password' => 'Password123'
    ]);
});

//Call all routes for the below contoller implicitly
//Public/Unprotected routes
Route::resource('todos', TodoController::class);

// Protected Routes/ Need user to be authenticated before api endpoints exposed
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/todos/search/{description}', [TodoController::class, 'search']); //This rout is not implicitly contained in the controller, so we call it explicitly
});

// Route::get('/todos', [TodoController::class, 'index']);  //Calling
// Route::post('/todos', [TodoController::class, 'store']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
