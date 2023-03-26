<?php

use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\PharmaciesController;
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

    Route::post('/organization', [OrganizationsController::class, 'organization'])->name('organization');

//    Route::prefix('organization')->group(function () {
//        Route::post('/add', [OrganizationsController::class, 'addOrganization'])->name('addOrganization');
//        Route::post('/remove/{id}', [OrganizationsController::class, 'removeOrganization'])->name('removeOrganization');
//        Route::post('/edit/{id}', [OrganizationsController::class, 'editOrganization'])->name('editOrganization');
//
//
//        Route::get('?page={$page}', [OrganizationsController::class, 'organizationPage'])->name('organizationPage');
//    });

    Route::post('/organization/pharmacies', [PharmaciesController::class, 'pharmacy'])->name('getPharmacies');

//    Route::prefix('organization/pharmacies')->group(function () {
//        Route::post('/{id}', [PharmaciesController::class, 'pharmacy'])->name('getPharmacies');
//        Route::post('/remove/{id}', [PharmaciesController::class, 'pharmacy'])->name('removePharmacy');
//        Route::post('/edit/{id}', [PharmaciesController::class, 'pharmacy'])->name('editPharmacy');
//
//    });

});

Auth::routes([
//    'register' => false,
    'reset' => false,
    'verify' => false,
]);
