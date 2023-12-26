<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;

class ExchangeCryptoLogController extends Controller
{
    /**
     * Method for exchange crypto logs
     */
    public function index(){
        $page_title     = "All Exchange Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)->get();
        
        return view('admin.sections.crypto-logs.exchange-crypto.all',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for pending exchange crypto logs
     */
    public function pending(){
        $page_title     = "Pending Exchange Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)->where('status',global_const()::STATUS_PENDING)->get();

        return view('admin.sections.crypto-logs.exchange-crypto.pending',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for confirm exchange crypto logs
     */
    public function confirm(){
        $page_title     = "Confirm Exchange Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)->where('status',global_const()::STATUS_CONFIRM_PAYMENT)->get();

        return view('admin.sections.crypto-logs.exchange-crypto.confirm',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for complete exchange crypto logs
     */
    public function complete(){
        $page_title     = "Complete Exchange Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)->where('status',global_const()::STATUS_COMPLETE)->get();

        return view('admin.sections.crypto-logs.exchange-crypto.complete',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for canceled exchange crypto logs
     */
    public function canceled(){
        $page_title     = "Canceled Exchange Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)->where('status',global_const()::STATUS_CANCEL)->get();

        return view('admin.sections.crypto-logs.exchange-crypto.cancel',compact(
            'page_title',
            'transactions'
        ));
    }
}
