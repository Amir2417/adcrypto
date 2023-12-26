<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;

class WithdrawCryptoLogController extends Controller
{
    /**
     * Method for withdraw crypto logs
     */
    public function index(){
        $page_title     = "All Withdraw Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)->get();
        
        return view('admin.sections.crypto-logs.withdraw-crypto.all',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for pending withdraw crypto logs
     */
    public function pending(){
        $page_title     = "Pending Withdraw Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)->where('status',global_const()::STATUS_PENDING)->get();

        return view('admin.sections.crypto-logs.withdraw-crypto.pending',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for confirm withdraw crypto logs
     */
    public function confirm(){
        $page_title     = "Confirm Withdraw Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)->where('status',global_const()::STATUS_CONFIRM_PAYMENT)->get();

        return view('admin.sections.crypto-logs.withdraw-crypto.confirm',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for complete withdraw crypto logs
     */
    public function complete(){
        $page_title     = "Complete Withdraw Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)->where('status',global_const()::STATUS_COMPLETE)->get();

        return view('admin.sections.crypto-logs.withdraw-crypto.complete',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for canceled withdraw crypto logs
     */
    public function canceled(){
        $page_title     = "Canceled Withdraw Crypto Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)->where('status',global_const()::STATUS_CANCEL)->get();

        return view('admin.sections.crypto-logs.withdraw-crypto.cancel',compact(
            'page_title',
            'transactions'
        ));
    }
}
