<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\PasswordResetController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//api routes 
Route::prefix('/user/v1')->group(function(){
    Route::post('/login', [LoginController::class, 'login']);
    Route::group(['middleware' => ['auth:api']], function () {

        //for registering a new user
        Route::post('/register', [RegisterController::class, 'register']);

        //updating an existing user 
        Route::put('/update-user', [UserController::class, 'updateUser']);

        //for get all users in the system
        Route::get('/get-users', [UserController::class, 'getUsers']);

        //for deactiving a user
        Route::post('/deactivate-user', [UserController::class, 'deactivate']);

        //reset user password
        Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

        //get a single user
        Route::get('/get-user/{id}', [UserController::class, 'getUser']);
        
    });
    
});

