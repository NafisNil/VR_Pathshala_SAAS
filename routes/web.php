<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ContentTypeController;
use App\Http\Controllers\FeatureTopicController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuestLinkController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionBuyController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/feature-topics', [FrontendController::class, 'featureTopics'])->name('featureTopics');
Route::get('/abouts', [FrontendController::class, 'abouts'])->name('abouts');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');



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
    Route::resource('feature_topics', FeatureTopicController::class);
    Route::resource('objectives', ObjectiveController::class);
    Route::resource('missions', MissionController::class);
    Route::resource('visions', VisionController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('quest_links', QuestLinkController::class);
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
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


//user routes
Route::post('message-send', [MessageController::class, 'store'])->name('message.send');

Route::get('user-login',[UserController::class, 'login_form'])->name('login.form');
Route::post('user-login', [UserController::class, 'login'])->name('user.login');
Route::post('user-logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('user-registration', [UserController::class, 'registration_form'])->name('registration.form');
Route::post('user-registration', [UserController::class, 'registration'])->name('registration');
Route::get('otp-verification', [UserController::class, 'otp_form'])->name('otp.form');
Route::post('otp-verification', [UserController::class, 'verify_otp'])->name('otp.verify');
Route::get('/forget-password-form', [UserController::class, 'forgetPasswordForm'])->name('forget.password.form');
Route::post('/forget-password-store', [UserController::class, 'forgetPassword'])->name('forget.password.store');

Route::get('/forget-password-request', [UserController::class, 'forgetPasswordRequestForm'])->name('forget.password.otp.form');
Route::post('/forget-password-request', [UserController::class, 'forgetPasswordRequest'])->name('forget.password.otp.request');

Route::get('/confirm-password-form', [UserController::class, 'confirmPasswordForm'])->name('confirm.password.form');
Route::post('/confirm-password-store', [UserController::class, 'confirmPassword'])->name('confirm.password.store');

Route::middleware(['auth', 'user'])->group(function () {
    // User routes go here
    Route::get('/user-dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user-profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::put('/user-profile-update', [UserController::class, 'updateProfile'])->name('user.profile.update');

    Route::get('/payment-history', [UserController::class, 'paymentHistory'])->name('payment.history');
    Route::get('/content-rating', [UserController::class, 'contentRatingForm'])->name('content-rating-form');
    Route::post('/content-rating', [UserController::class, 'submitContentRating'])->name('submit-content-rating');

    Route::get('/password-change-form', [UserController::class, 'passwordChangeForm'])->name('password.change.form');
    Route::put('/password-change', [UserController::class, 'changePassword'])->name('password.change');

    Route::get('/unlink-devices', [UserController::class, 'unlinkDevices'])->name('unlink.devices');
    Route::get('/buy-subscription/{planId}', [SubscriptionBuyController::class, 'buySubscription'])->name('buy.subscription');

   
    
});



//sslcommerz routes

Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/payment-form', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('payment.form');

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success'])->name('payment.success');
Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->name('payment.fail');
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('payment.cancel');

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('payment.ipn');
//SSLCOMMERZ END




require __DIR__.'/auth.php';
