<?php

namespace App\Http\Controllers\Admin;

use App\Constants\PaymentGatewayConst;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BuyCryptoLogController extends Controller
{
    /**
     * Method for buy crypto logs
     */
    public function index(){
        $page_title     = "All Buy Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::BUY_CRYPTO)->get();

        return view('admin.sections.crypto-logs.buy-crypto.all',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for pending buy crypto logs
     */
    public function pending(){
        $page_title     = "Pending Buy Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::BUY_CRYPTO)->where('status',global_const()::STATUS_PENDING)->get();

        return view('admin.sections.crypto-logs.buy-crypto.pending',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for confirm buy crypto logs
     */
    public function confirm(){
        $page_title     = "Confirm Buy Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::BUY_CRYPTO)->where('status',global_const()::STATUS_CONFIRM_PAYMENT)->get();

        return view('admin.sections.crypto-logs.buy-crypto.confirm',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for complete buy crypto logs
     */
    public function complete(){
        $page_title     = "Complete Buy Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::BUY_CRYPTO)->where('status',global_const()::STATUS_COMPLETE)->get();

        return view('admin.sections.crypto-logs.buy-crypto.complete',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for canceled buy crypto logs
     */
    public function canceled(){
        $page_title     = "Canceled Buy Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::BUY_CRYPTO)->where('status',global_const()::STATUS_CANCEL)->get();

        return view('admin.sections.crypto-logs.buy-crypto.cancel',compact(
            'page_title',
            'transactions'
        ));
    }
}
