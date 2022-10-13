<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Company\CompanyController;
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

        /****************************************************************
        *ALL ROUTES BELOW LOGIN TO USER AUTHENTICATION AND USER MANAGEMENT
        *
        *{/Register, for adding new users},{/update-user, for updating users details}
        *{/get-users, retrieve all users},{/deactivate-user, for making user inactive}
        *{/Register, for adding new users},{/reset-password, for changing user password}
        *{/get-user/{id}, for retriving asing users},{/logout, for unauthenticating user}
        /****************************************************************/
        Route::group(['middleware' => ['role:Admin']], function () {
            Route::post('/register', [RegisterController::class, 'register']);
            Route::post('/update-user', [UserController::class, 'updateUser']);
            Route::get('/get-users', [UserController::class, 'getUsers']);
            Route::post('/deactivate-user', [UserController::class, 'deactivate']);
            Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
            Route::get('/get-user/{id}', [UserController::class, 'getUser']);
            Route::post('/logout', [LogoutController::class, 'logout']);
        });

        /*********************************************************************
         * END OF USER MANAGEMENT ROUTES
         *********************************************************************/
        

        /******************************************************************************
         * COMPANY ROUTES, ALL ROUTES HERE ARE RESPONSIBLE FOR COMPANY MANAGEMENT
         *{/add-company, for adding new companys},{/update-company, for updating company details}
         *{/all-companies, returns all companies}
         ********************************************************************************/
        Route::group(['middleware' => ['role:Admin']], function () {
            Route::post('/add-company', [CompanyController::class, 'addCompany']);
            Route::post('/update-company', [CompanyController::class, 'updateCompany']);
            Route::get('/get-companies', [CompanyController::class, 'getCompanies']);
            Route::post('/deactivate-company', [CompanyController::class, 'deactivateCompany']);
            Route::post('/activate-company', [CompanyController::class, 'activateCompany']);
        });    
        

    });
    
});

