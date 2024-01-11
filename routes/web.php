<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

Route::get('/', function () {
    return view('auth.login');
});

//Admin dashboard route
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

//Fundraiser dashboard route
Route::get('/fundraiser/dashboard', function () {
    return view('fundraiser.dashboard');
})->middleware(['auth', 'verified'])->name('fundraiser.dashboard');

//Customer dashboard route
Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->middleware(['auth', 'verified'])->name('customer.dashboard');

//Customer setting route

// Route::get('/customer/setting', function () {
//     return view('customer.setting.index');
// })->middleware(['auth', 'verified'])->name('setting');

Route::middleware('auth')->group(function () {
    Route::get('/customer/profile', [ProfileController::class, 'customerEdit'])->name('customer.profile.edit');
    Route::get('/fundraiser/profile', [ProfileController::class, 'fundraiseredit'])->name('fundraiser.profile.edit');

    Route::patch('/customer/profile', [ProfileController::class, 'customerUpdate'])->name('customer.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
