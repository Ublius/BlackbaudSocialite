<?php

use App\Http\Controllers\Auth\BlackbaudController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('auth/blackbaud/redirect', [BlackbaudController::class, 'handleBlackbaudRedirect']);
Route::get('auth/callback/blackbaud', 'BlackbaudController@handleBlackbaudCallback');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
