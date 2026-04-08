<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\UserSubscriptionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//user api
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/fb-login', [AuthController::class, 'handleFacebookLogin']);

//get plan
Route::get('/plans', [PlanController::class, 'index']);

//otp verification
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

//unlink device
Route::post('/unlink-device-request', [AuthController::class, 'unlinkDeviceRequest']);
Route::post('/unlink-device-confirm', [AuthController::class, 'unlinkDeviceConfirm']);

//check subscription
Route::get('/check-subscription', [UserSubscriptionController::class, 'checkSubscription']);
Route::post('/make-subscription', [UserSubscriptionController::class, 'makeSubscription']);
Route::post('/cancel-subscription', [UserSubscriptionController::class, 'cancelSubscription']);
Route::get('/check-cancellation-request', [UserSubscriptionController::class, 'cancelRequestCheck']);

//user info
Route::get('/user-info', [AuthController::class, 'userInfo']);
//change password
Route::post('/change-password', [UserSubscriptionController::class, 'changePassword']);
Route::get('/get-profile-info', [AuthController::class, 'getProfileInfo']);


Route::middleware('auth:sanctum')->group(function () {
    // Protected routes for authenticated users
    Route::post('/logout', [AuthController::class, 'logout']);

    
});