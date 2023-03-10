<?php

use App\Http\Controllers\OrganizationsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/', [OrganizationsController::class, 'dashboard'])->name('home');
    Route::get('/organizations', [OrganizationsController::class, 'organizations'])->name('organizations');
    Route::get('/settings', [OrganizationsController::class, 'settings'])->name('settings');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
