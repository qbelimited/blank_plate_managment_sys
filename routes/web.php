<?php

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

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


/*------------------------------------------
--------------------------------------------
All Manufacturers Routes List
--------------------------------------------
--------------------------------------------*/

Route::middleware(['auth', 'user-access:manufacturer'])->group(function () {
    Route::get('/manufacturer/home', [App\Http\Controllers\HomeController::class, 'manHome'])->name('man.home');
});


/*------------------------------------------
--------------------------------------------
All DVLA Routes List
--------------------------------------------
--------------------------------------------*/

Route::middleware(['auth', 'user-access:dvla'])->group(function () {
    Route::get('/dvla/home', [App\Http\Controllers\HomeController::class, 'dvlaHome'])->name('dvla.home');
});


/*------------------------------------------
--------------------------------------------
All Embossers Routes List
--------------------------------------------
--------------------------------------------*/

Route::middleware(['auth', 'user-access:embosser'])->group(function () {
    Route::get('/embosser/home', [App\Http\Controllers\HomeController::class, 'embHome'])->name('emb.home');
});
