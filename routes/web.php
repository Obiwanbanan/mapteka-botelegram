<?php

use App\Http\Controllers\ChatBotsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\PharmaciesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TelegramBotsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
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
    Route::get('/', [OrganizationsController::class, 'index'])->name('home');
    Route::post('/menu', [MenuController::class, 'menu'])->name('menu');
    Route::post('/organization', [OrganizationsController::class, 'organization'])->name('organization');
    Route::post('/settings', [SettingsController::class, 'settings'])->name('settings');
    Route::post('/chatBots', [ChatBotsController::class, 'chatBots'])->name('chatBots');
    Route::post('/organization/pharmacies', [PharmaciesController::class, 'pharmacy'])->name('getPharmacies');
});

Route::post('/{bot_token}/webhook', [TelegramBotsController::class, 'TelegramBotLogic'])->name('TelegramBotLogic');

Auth::routes([
//    'register' => false,
    'reset' => false,
    'verify' => false,
]);
