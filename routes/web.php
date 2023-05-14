<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChatBotsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\PharmaciesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TelegramBotsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

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
//    Route::post('/menu', [MenuController::class, 'menu'])->name('menu');
//    Route::post('/organization', [OrganizationsController::class, 'organization'])->name('organization');
//    Route::post('/settings', [SettingsController::class, 'settings'])->name('settings');
//    Route::post('/chatBots', [ChatBotsController::class, 'chatBots'])->name('chatBots');

    Route::get('/chat-bots', [ChatBotsController::class, 'chatBots'])->name('chat-bots');
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');
    Route::prefix('organization')->group(function (){
        Route::get('/', [OrganizationsController::class, 'index'])->name('organization');
        Route::get('/add', [OrganizationsController::class, 'add'])->name('organization');
        Route::get('/edit/{id}', [OrganizationsController::class, 'edit'])->name('organization');
        Route::post('/delete/{id}', [OrganizationsController::class, 'delete'])->name('organization');
    });
    Route::post('/organization/pharmacies', [PharmaciesController::class, 'pharmacy'])->name('getPharmacies');
});

Route::post('/{bot_token}/webhook', [TelegramBotsController::class, 'TelegramBotLogic'])->name('TelegramBotLogic');

Auth::routes([
//    'register' => false,
    'reset' => false,
    'verify' => false,
]);
