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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [OrganizationsController::class, 'index'])->name('home');
    Route::post('/dashboard', [OrganizationsController::class, 'dashboard'])->name('dashboard');
    Route::post('/organizations', [OrganizationsController::class, 'organizations'])->name('organizations');
    Route::post('/settings', [OrganizationsController::class, 'settings'])->name('settings');

    Route::prefix('organization')->group(function () {
        Route::post('/add', [OrganizationsController::class, 'addOrganization'])->name('addOrganization');
        Route::post('/remove/{id}', [OrganizationsController::class, 'removeOrganization'])->name('removeOrganization');
        Route::post('/edit/{id}', [OrganizationsController::class, 'editOrganization'])->name('editOrganization');


        Route::get('?page={$page}', [OrganizationsController::class, 'organizationPage'])->name('organizationPage');
    });

    Route::prefix('organization/pharmacies')->group(function () {
        Route::post('/{id}', [OrganizationsController::class, 'getPharmacies'])->name('getPharmacies');
        Route::post('/remove/{id}', [OrganizationsController::class, 'removePharmacies'])->name('removePharmacies');

    });

});

Auth::routes([
//    'register' => false,
    'reset' => false,
    'verify' => false,
]);
