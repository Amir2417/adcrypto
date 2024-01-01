<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\User\ProfileController;
use App\Http\Controllers\Api\V1\User\MyBookingController;
use App\Http\Controllers\Api\V1\User\AuthorizationController;
use App\Http\Controllers\Api\V1\User\ParlourBookingController;

Route::prefix("user")->name("api.user.")->group(function(){
    
    Route::middleware('auth:api')->group(function(){
        Route::post('google-2fa/otp/verify', [AuthorizationController::class,'verify2FACode']);
        
        Route::controller(ProfileController::class)->prefix('profile')->group(function(){
            Route::get('info','profileInfo');
            Route::post('info/update','profileInfoUpdate');
            Route::post('password/update','profilePasswordUpdate');
        });
        // Logout Route
        Route::post('logout',[ProfileController::class,'logout']);
        Route::get('notification',[SettingController::class,'notification']);

        
    });
    
    
    
    
});


