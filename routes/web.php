<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ContentTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes go here
    Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    //plan routes
    Route::resource('plans', PlanController::class);
    Route::resource('benefits', BenefitController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('contentTypes', ContentTypeController::class);
    Route::get('make-active/{id}', [PlanController::class, 'makeActive'])->name('plans.makeActive');
    Route::get('make-inactive/{id}', [PlanController::class, 'makeInactive'])->name('plans.makeInactive');


    //all users route
    Route::get('/users', [HomeController::class, 'users'])->name('users.index');
    Route::get('/users/{id}', [HomeController::class, 'show'])->name('users.show');
    Route::get('/make-user-suspended/{id}', [HomeController::class, 'makeUserSuspended'])->name('users.makeUserSuspended');
    Route::get('/make-user-active/{id}', [HomeController::class, 'makeUserActive'])->name('users.makeUserActive');

    //subscription routes
    Route::get('/subscriptions', [HomeController::class, 'subscriptions'])->name('subscriptions.index');

    //payment routes
    Route::get('/payments', [HomeController::class, 'payments'])->name('payments.index');



});






require __DIR__.'/auth.php';
