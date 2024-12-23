<?php

use App\Http\Controllers\Admin\CodeReedemController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\OauthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Route\AdminController;
use App\Http\Controllers\Route\UserPageController;
use App\Http\Controllers\User\UserPointController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('sudut-potong/admin')->group(function () {
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

    Route::middleware(AdminAuthMiddleware::class)->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // UserManagement
        Route::get('user-management', [UserManagementController::class, 'index'])->name('admin.user-management.index');
        Route::post('user-management/store-point', [UserManagementController::class, 'storePoint'])->name('admin.user-management.store-point');
        Route::get('user-management/show-point/{userId}', [UserManagementController::class, 'showHistory'])->name('admin.user-management.history');
        Route::delete('user-management/user-delete/{userId}', [UserManagementController::class, 'deleteUser'])->name('admin.user-management.delete');

        // CodeReedem
        Route::get('code-reedem', [CodeReedemController::class, 'index'])->name('admin.code-reedem.index');
        Route::post('code-reedem/store', [CodeReedemController::class, 'store'])->name('admin.code-reedem.store');
        Route::delete('code-reedem/delete-code/{codeId}', [CodeReedemController::class, 'deleteCode'])->name('admin.code-reedem.delete');

        // Review
        Route::get('review', [ReviewController::class, 'index'])->name('admin.review.index');
        Route::post('review/toggle-approval/{id}', [ReviewController::class, 'toggleApproval'])->name('admin.review.toggle-approval');
    });
});

Route::get('/', [UserPageController::class, 'index'])->name('home');

Route::prefix('/')->group(function () {
    Route::get('oauth/google/redirect', [OauthController::class, 'redirectToProvider'])->name('user.oauth.google');
    Route::get('oauth/google/callback', [OauthController::class, 'handleProviderCallback'])->name('user.oauth.google.callback');
    Route::middleware(UserMiddleware::class)->group(function () {
        Route::post('logout', [UserAuthController::class, 'logout'])->name('user.logout');
        Route::get('me', [UserAuthController::class, 'me'])->name('user.me');

        //  Review
        Route::get('review', [\App\Http\Controllers\User\ReviewController::class, 'index'])->name('user.review');
        Route::post('review', [\App\Http\Controllers\User\ReviewController::class, 'store'])->name('user.review.store');

        // History Point
        Route::get('history-point', [UserPointController::class, 'showHistory'])->name('user.history-point');

        // Redeem Code
        Route::post('reedem-code', [UserPointController::class, 'reedemCode'])->name('user.reedem-code');
    });

});

