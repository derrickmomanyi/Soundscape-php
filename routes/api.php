<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api'], function () {
     /**
     * API V1 Collection
     */
    Route::prefix('v1')->group(function () {
         /**
         * Auth APIs
         */        
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::put('me', [AuthController::class, 'updateProfileInformation']);
        Route::post('change-password', [AuthController::class, 'changePassword']);

        // /**
        //  * Password Resets APIs
        //  */
        // Route::prefix('password-reset')->group(function () {
        //     Route::post('request-code', [PasswordResetController::class, 'requestCode']);
        //     Route::post('validate-code', [PasswordResetController::class, 'validateCode']);
        //     Route::post('update-password', [PasswordResetController::class, 'updatePassword']);
        // });
    });
});
