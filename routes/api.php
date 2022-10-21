<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Company\CompanyController;
use App\Http\Controllers\Api\Embosser\EmbosserController;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use App\Http\Controllers\Api\PlateProduction\PlateController;
use App\Http\Controllers\Api\Settings\PlateSettingsController;

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
Route::prefix('/npms/v1')->group(function(){
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::group(['middleware' => ['auth:api']], function () {

        /****************************************************************
        *ALL ROUTES BELOW LOGIN TO USER AUTHENTICATION AND USER MANAGEMENT
        *
        *{/Register, for adding new users},{/update-user, for updating users details}
        *{/get-users, retrieve all users},{/deactivate-user, for making user inactive}
        *{/activate-user, for adding new users},{/reset-password, for changing user password}
        *{/get-user/{id}, for retriving asing users},{/logout, for unauthenticating user}
        /****************************************************************/
        Route::group(['middleware' => ['role:Admin']], function () {
            Route::post('/register', [RegisterController::class, 'register']);
            Route::post('/update-user', [UserController::class, 'updateUser']);
            Route::get('/get-users', [UserController::class, 'getUsers']);
            Route::post('/deactivate-user', [UserController::class, 'deactivate']);
            Route::post('/activate-user', [UserController::class, 'activate']);
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
         *{/all-companies, returns all companies},{/get-companies,returns all company},{/deactivate-company,deactivate company},
         *{/activate-company, activate company},
         ********************************************************************************/
            Route::group(['middleware' => ['role:Admin']], function () {
                Route::post('/add-company', [CompanyController::class, 'addCompany']);
                Route::post('/update-company', [CompanyController::class, 'updateCompany']);
                Route::get('/get-companies', [CompanyController::class, 'getCompanies']);
                Route::post('/deactivate-company', [CompanyController::class, 'deactivateCompany']);
                Route::post('/activate-company', [CompanyController::class, 'activateCompany']);
            });   
        /**********************************************************************
         * END OF COMPANY MANAGEMENT ROUTES
         *********************************************************************/
        
        

         /******************************************************************************
         * PLATE COLOR ROUTES, ALL ROUTES HERE ARE RESPONSIBLE FOR PLATE COLRS
         *{/add-plate-color, for adding plate colors},{/update-plate-color, for updating plate colors}
         *{/get-plate-colors, gets all plate colors},{/deactivate-plate-color,deactivates the plate color},{/activate-plate-color, activates the plate color},
         ********************************************************************************/
            Route::group(['middleware' => ['role:Admin|Manufacturer']], function () {
                Route::post('/add-plate-color', [PlateSettingsController::class, 'addPlateColor']);
                Route::post('/update-plate-color', [PlateSettingsController::class, 'updatePlateColor']);
                Route::get('/get-plate-colors', [PlateSettingsController::class, 'getPlateColors']);
                Route::post('/deactivate-plate-color', [PlateSettingsController::class, 'deactivatePlateColor']);
                Route::post('/activate-plate-color', [PlateSettingsController::class, 'activatePlateColor']);
            });   
        /**********************************************************************
         * END OF PLATE COLORS ROUTES
         *********************************************************************/


         
         /******************************************************************************
         * EMBOSSER COLOR ROUTES, ALL ROUTES HERE ARE RESPONSIBLE FOR EMBOSSER COLRS
         *{/add-embosser-color, for adding embosser colors},{/update-embosser-color, for updating embosser colors}
         *{/get-embosser-colors, gets all embosser colors},{/deactivate-embosser-color,deactivates the embosser color},{/activate-embosser-color, activates the embosser color},
         ********************************************************************************/
            Route::group(['middleware' => ['role:Admin|Manufacturer']], function () {
                Route::post('/add-embosser-color', [PlateSettingsController::class, 'addEmbosserColor']);
                Route::post('/update-embosser-color', [PlateSettingsController::class, 'updateEmbosserColor']);
                Route::get('/get-embosser-colors', [PlateSettingsController::class, 'getEmbosserColors']);
                Route::post('/deactivate-embosser-color', [PlateSettingsController::class, 'deactivateEmbosserColor']);
                Route::post('/activate-embosser-color', [PlateSettingsController::class, 'activateEmbosserColor']);
            });   
        /**********************************************************************
         * END OF PLATE COLORS ROUTES
         *********************************************************************/


        /******************************************************************************
         * PLATE DIMENSION ROUTES, ALL ROUTES HERE ARE RESPONSIBLE FOR PLATE DIMENSIONS
         *{/add-plate-dimension, for adding plate dimensions},{/update-plate-dimensions, for updating plate dimensions}
         *{/get-plate-dimensions, gets all plate dimensions},{/deactivate-plate-dimension,deactivates the plate dimensions},{/activate-plate-dimensions, activates the plate dimensions},
         ********************************************************************************/
            Route::group(['middleware' => ['role:Admin|Manufacturer']], function () {
                Route::post('/add-plate-dimension', [PlateSettingsController::class, 'addPlateDimension']);
                Route::post('/update-plate-dimension', [PlateSettingsController::class, 'updatePlateDimension']);
                Route::get('/get-plate-dimensions', [PlateSettingsController::class, 'getPlateDimensions']);
                Route::post('/deactivate-plate-dimension', [PlateSettingsController::class, 'deactivatePlateDimension']);
                Route::post('/activate-plate-dimension', [PlateSettingsController::class, 'activatePlateDimension']);
            });   
        /**********************************************************************
         * END OF PLATE DIMENSION ROUTES
         *********************************************************************/


         /******************************************************************************
         * PRODUCTION WEEK ROUTES, ALL ROUTES HERE ARE RESPONSIBLE FOR PLATE DIMENSIONS
         *{/add-production-week, for adding production weeks},{/update-production-week, for updating the production weeks}
         *{/get-production-weeks, gets all production weeks},{/deactivate-production-week,makes a production week inactive},{/activate-production-week, activates the production week},
         ********************************************************************************/
            Route::group(['middleware' => ['role:Admin|Manufacturer']], function () {
                Route::post('/add-production-week', [PlateSettingsController::class, 'addProductionWeek']);
                Route::post('/update-production-week', [PlateSettingsController::class, 'updateProductionWeek']);
                Route::get('/get-production-weeks', [PlateSettingsController::class, 'getProductionWeeks']);
                Route::post('/deactivate-production-week', [PlateSettingsController::class, 'deactivateProductionWeek']);
                Route::post('/activate-production-week', [PlateSettingsController::class, 'activateProductionWeek']);
            });   
        /**********************************************************************
         * END OF PRODUCTION WEEK ROUTES
         *********************************************************************/


         /******************************************************************************
         * PRODUCTION YEAR ROUTES, ALL ROUTES HERE ARE RESPONSIBLE FOR PLATE DIMENSIONS
         *{/add-production-year, for adding production years},{/update-production-year, for updating the production years}
         *{/get-production-years, gets all production years},{/deactivate-production-year,makes a production year inactive},{/activate-production-year, activates the production year},
         ********************************************************************************/
            Route::group(['middleware' => ['role:Admin|Manufacturer']], function () {
                Route::post('/add-production-year', [PlateSettingsController::class, 'addProductionYear']);
                Route::post('/update-production-year', [PlateSettingsController::class, 'updateProductionYear']);
                Route::get('/get-production-years', [PlateSettingsController::class, 'getProductionYears']);
                Route::post('/deactivate-production-year', [PlateSettingsController::class, 'deactivateProductionYear']);
                Route::post('/activate-production-year', [PlateSettingsController::class, 'activateProductionYear']);
            });   
        /**********************************************************************
         * END OF PRODUCTION WEEK ROUTES
         *********************************************************************/



         /******************************************************************************
         * PRODUCTION OF NUMBER PLATE BATCHES, ALL ROUTES HERE ARE RESPONSIBLE FOR NUMBER PLATE BATCHES
         *{/add-production, for creating number plate batches},{/get-all-production, for retriving all the batches}
         ********************************************************************************/
         Route::group(['middleware' => ['role:Admin|Manufacturer']], function () {
            Route::post('/add-production', [PlateController::class, 'addPlateProductionBatch']);
         });  
         Route::group(['middleware' => ['role:Admin|Manufacturer|Dvla']], function () {
            Route::get('/get-all-production', [PlateController::class, 'getAllProduction']);
         });

         /**********************************************************************
         * END OF NUMBER PLATE BATCHES
         *********************************************************************/



         /******************************************************************************
         * EMBOSSER ROUTES, ALL ROUTES HERE ARE RESPONSIBLE FOR EMBOSSER FUNCTIONS
         *{/add-production, for creating number plate batches},{/get-all-production, for retriving all the batches}
         ********************************************************************************/
         Route::group(['middleware' => ['role:Admin|Embosser|Dvla']], function () {
            Route::post('/emboss-plate', [EmbosserController::class, 'embossPlate']);
            Route::get('/get-all-embossed', [EmbosserController::class, 'getAllEmbossed']);
            Route::post('/update-embossed-plate', [EmbosserController::class, 'updateEmbossedPlate']);
            
         }); 

         /**********************************************************************
         * END OF EMBOSSER
         *********************************************************************/
         
         
         
        /******************************************************************************
         * PLATE ROUTES, ALL ROUTES HERE ARE RESPONSIBLE FOR EMBOSSER FUNCTIONS
         *{/add-production, for creating number plate batches},{/get-all-production, for retriving all the batches}
         ********************************************************************************/
         Route::group(['middleware' => ['role:Admin|Dvla']], function () {
            Route::get('/get-all-plates', [PlateController::class, 'getNumbrPlates']);
            Route::get('/get-plate/{name}', [PlateController::class, 'getPlate']);
         }); 

         /**********************************************************************
         * END OF EMBOSSER
         *********************************************************************/

         
        
        

    });
    
});

