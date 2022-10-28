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


//Public/Unprotected routes
// Route::resource('todos', TodoController::class);

// Protected Routes. You need a token to be able to do these
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('todos', TodoController::class);    //Call all routes for the Controller implicitly
    Route::get('/todos/search/{description}', [TodoController::class, 'search']); //This rout is not implicitly contained in the controller, so we call it explicitly
});

// Route::get('/todos', [TodoController::class, 'index']);  //Calling
// Route::post('/todos', [TodoController::class, 'store']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
