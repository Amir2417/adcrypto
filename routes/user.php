<?php

use App\Http\Controllers\User\BuyCryptoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ExchangeCryptoController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SecurityController;
use App\Http\Controllers\User\SellCryptoController;
use App\Http\Controllers\User\SupportTicketController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\User\WithdrawCryptoController;

Route::prefix("user")->name("user.")->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('dashboard','index')->name('dashboard');
        Route::post('logout','logout')->name('logout');
        Route::delete('delete/account','deleteAccount')->name('delete.account')->middleware(['app.mode']);;
    });

    Route::controller(ProfileController::class)->prefix("profile")->name("profile.")->group(function(){
        Route::get('/','index')->name('index');
        Route::put('password/update','passwordUpdate')->name('password.update')->middleware(['app.mode']);;
        Route::put('update','update')->name('update')->middleware(['app.mode']);;
    });

    // wallet 
    Route::controller(WalletController::class)->prefix('wallet')->name('wallet.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('wallet-details/{public_address}','walletDetails')->name('details');
    });

    //buy crypto
    Route::controller(BuyCryptoController::class)->prefix('buy-crypto')->name('buy.crypto.')->group(function(){
        Route::get('/','index')->name('index');
    });

    //sell crypto
    Route::controller(SellCryptoController::class)->prefix('sell-crypto')->name('sell.crypto.')->group(function(){
        Route::get('/','index')->name('index');
    });

    //withdraw crypto
    Route::controller(WithdrawCryptoController::class)->prefix('withdraw-crypto')->name('withdraw.crypto.')->group(function(){
        Route::get('/','index')->name('index');
    });

    //exchange crypto
    Route::controller(ExchangeCryptoController::class)->prefix('exchange-crypto')->name('exchange.crypto.')->group(function(){
        Route::get('/','index')->name('index');
    });

    //buy log
    Route::controller(TransactionController::class)->prefix('transaction')->name('transaction.')->group(function(){
        Route::get('buy-log','buyLog')->name('buy.log');
        Route::get('sell-log','sellLog')->name('sell.log');
        Route::get('withdraw-log','withdrawLog')->name('withdraw.log');
        Route::get('exchange-log','exchangeLog')->name('exchange.log');
    });

    //security
    Route::controller(SecurityController::class)->prefix('security')->name('security.')->group(function(){
        Route::get('google/2fa','google2FA')->name('google.2fa')->middleware('app.mode');
        Route::post('google/2fa/status/update','google2FAStatusUpdate')->name('google.2fa.status.update')->middleware('app.mode');
    });

    //support ticket
    Route::controller(SupportTicketController::class)->prefix("prefix")->name("support.ticket.")->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('conversation/{encrypt_id}','conversation')->name('conversation');
        Route::post('message/send','messageSend')->name('message.send');
    });

});
