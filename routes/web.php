<?php

use App\Http\Controllers\ChatBotsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\PharmaciesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TelegramBotsController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('chat-bots')->group(function () {
        Route::get('/', [ChatBotsController::class, 'index'])->name('chat-bots');
        Route::match(['GET', 'POST'],'/add', [ChatBotsController::class, 'add'])->name('chat-bots-add');
        Route::post('/update', [ChatBotsController::class, 'update'])->name('chat-bots-update');
        Route::delete('/remove', [ChatBotsController::class, 'remove'])->name('chat-bots-remove');
    });

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::prefix('organization')->group(function () {
        Route::get('/', [OrganizationsController::class, 'index'])->name('organization');
        Route::match(['GET', 'POST'],'/add', [OrganizationsController::class, 'add'])->name('organization-add');
        Route::match(['GET', 'POST'],'/{id}/update', [OrganizationsController::class, 'update'])->name('organization-update');
        Route::delete('/remove', [OrganizationsController::class, 'remove'])->name('organization-remove');
        Route::post('/pagination-with-param', [OrganizationsController::class, 'paginationWithParam'])->name('organization-pagination-with-param');
        Route::get('/search', [OrganizationsController::class, 'search'])->name('organization-search');
    });

    Route::prefix('pharmacies')->group(function () {
        Route::get('/', [PharmaciesController::class, 'index'])->name('pharmacies');
        Route::match(['GET', 'POST'],'/add', [PharmaciesController::class, 'add'])->name('pharmacy-add');
        Route::match(['GET', 'POST'],'/{id}/update', [PharmaciesController::class, 'update'])->name('pharmacy-update');
        Route::delete('/remove', [PharmaciesController::class, 'remove'])->name('pharmacy-remove');
        Route::get('/search', [PharmaciesController::class, 'search'])->name('pharmacy-search');
        Route::post('/pagination-with-param', [PharmaciesController::class, 'paginationWithParam'])->name('pharmacy-pagination-with-param');
    });

    Route::post('/organization/pharmacies', [PharmaciesController::class, 'pharmacy'])->name('getPharmacies');
});

Route::post('/{bot_token}/webhook', [TelegramBotsController::class, 'TelegramBotLogic'])->name('TelegramBotLogic');

Auth::routes([
//    'register' => false,
    'reset' => false,
    'verify' => false,
]);
