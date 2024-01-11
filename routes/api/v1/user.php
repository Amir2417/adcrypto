<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\User\ProfileController;
use App\Http\Controllers\Api\V1\User\MyBookingController;
use App\Http\Controllers\Api\V1\User\AuthorizationController;
use App\Http\Controllers\Api\V1\User\BuyCryptoController;
use App\Http\Controllers\Api\V1\User\ExchangeCryptoController;
use App\Http\Controllers\Api\V1\User\ParlourBookingController;
use App\Http\Controllers\Api\V1\User\SellCryptoController;
use App\Http\Controllers\Api\V1\User\TransactionLogController;
use App\Http\Controllers\Api\V1\User\WithdrawCryptoController;

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

        //transaction logs 
        Route::controller(TransactionLogController::class)->prefix('transaction')->group(function(){
            Route::get('buy-log','buyLog');
            Route::get('sell-log','sellLog');
            Route::get('withdraw-log','withdrawLog');
            Route::get('exchange-log','exchangeLog');
        });

        //buy crypto 
        Route::controller(BuyCryptoController::class)->prefix('buy-crypto')->name('buy.crypto.')->group(function(){
            Route::get('index','index');
            Route::post('store','store');
            Route::post('submit','submit');
             // POST Route For Unauthenticated Request
            Route::post('success/response/{gateway}', 'postSuccess')->name('payment.success')->withoutMiddleware(['auth:api']);
            Route::post('cancel/response/{gateway}', 'postCancel')->name('payment.cancel')->withoutMiddleware(['auth:api']);
        
            // Automatic Gateway Response Routes
            Route::get('success/response/{gateway}','success')->withoutMiddleware(['auth:api'])->name("payment.success");
            Route::get("cancel/response/{gateway}",'cancel')->withoutMiddleware(['auth:api'])->name("payment.cancel");

            Route::get('manual/input-fields','manualInputFields'); 
            Route::post("manual/submit","manualSubmit");

            Route::get('payment-gateway/additional-fields','gatewayAdditionalFields');
            
            Route::prefix('payment')->name('payment.')->group(function() {
                Route::post('crypto/confirm/{trx_id}','cryptoPaymentConfirm')->name('crypto.confirm');
            });
        });
        
        //sell crypto 
        Route::controller(SellCryptoController::class)->prefix('sell-crypto')->group(function(){
            Route::get('index','index');
            Route::post('store','store');
            Route::post('payment-info-store','paymentInfoStore');
            Route::post('sell-payment-store','sellPaymentStore');
            Route::post('confirm','confirm');
        });

        //withdraw crypto 
        Route::controller(WithdrawCryptoController::class)->prefix('withdraw-crypto')->group(function(){
            Route::get('index','index');
            Route::post('store','store');
            Route::post('confirm','confirm');
        });
        //sell crypto 
        Route::controller(ExchangeCryptoController::class)->prefix('exchange-crypto')->group(function(){
            Route::get('index','index');
            Route::post('store','store');
            Route::post('confirm','confirm');
        });
        
    });
    
    
    
    
});


