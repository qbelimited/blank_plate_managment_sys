<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Super admin Routes List
--------------------------------------------
--------------------------------------------*/

// Route::middleware(['auth', 'user-access:admin'])->group(function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::get('/plates', [App\Http\Controllers\PlateController::class, 'allPlate'])->name('plate');
// });

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/plates', [App\Http\Controllers\PlateController::class, 'allPlate'])->name('plate');
});


/*------------------------------------------
--------------------------------------------
All Manufacturers Routes List
--------------------------------------------
--------------------------------------------*/

// Route::middleware(['auth', 'user-access:manufacturer'])->group(function () {
//     Route::get('/manufacturer/home', [App\Http\Controllers\HomeController::class, 'manHome'])->name('man.home');
//     Route::get('/manufacturer/plates', [App\Http\Controllers\HomeController::class, 'manHome'])->name('man.plate');
// });

Route::group(['middleware' => ['role:Manufacturer']], function () {
    Route::get('/manufacturer/home', [App\Http\Controllers\HomeController::class, 'manHome'])->name('man.home');
    Route::get('/manufacturer/plates', [App\Http\Controllers\HomeController::class, 'manHome'])->name('man.plate');
});


/*------------------------------------------
--------------------------------------------
All DVLA Routes List
--------------------------------------------
--------------------------------------------*/

// Route::middleware(['auth', 'user-access:dvla'])->group(function () {
//     Route::get('/dvla/home', [App\Http\Controllers\HomeController::class, 'dvlaHome'])->name('dvla.home');
//     Route::get('/dvla/plates', [App\Http\Controllers\HomeController::class, 'dvlaHome'])->name('dvla.plate');
// });

Route::group(['middleware' => ['role:Dvla']], function () {
    Route::get('/dvla/home', [App\Http\Controllers\HomeController::class, 'dvlaHome'])->name('dvla.home');
    Route::get('/dvla/plates', [App\Http\Controllers\HomeController::class, 'dvlaHome'])->name('dvla.plate');
});


/*------------------------------------------
--------------------------------------------
All Embossers Routes List
--------------------------------------------
--------------------------------------------*/

// Route::middleware(['auth', 'user-access:embosser'])->group(function () {
//     Route::get('/embosser/home', [App\Http\Controllers\HomeController::class, 'embHome'])->name('emb.home');
//     Route::get('/embosser/plates', [App\Http\Controllers\HomeController::class, 'embHome'])->name('emb.plate');
// });

Route::group(['middleware' => ['role:Embosser']], function () {
    Route::get('/dvla/home', [App\Http\Controllers\HomeController::class, 'dvlaHome'])->name('dvla.home');
    Route::get('/dvla/plates', [App\Http\Controllers\HomeController::class, 'dvlaHome'])->name('dvla.plate');
});
