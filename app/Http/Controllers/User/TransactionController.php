<?php

namespace App\Http\Controllers\User;

use App\Constants\PaymentGatewayConst;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Method for view buy log page
     * @return view
     */
    public function buyLog(){
        $page_title  = "- Buy Logs";
        $transactions = Transaction::where("type",PaymentGatewayConst::BUY_CRYPTO)->orderBy('id','desc')->get();
        
        return view('user.sections.transaction-logs.buy-log',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for view sell log page
     * @return view
     */
    public function sellLog(){
        $page_title  = "- Sell Logs";

        return view('user.sections.transaction-logs.sell-log',compact(
            'page_title',
        ));
    }
    /**
     * Method for view withdraw log page
     * @return view
     */
    public function withdrawLog(){
        $page_title     = "- Withdraw Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)->orderBy('id','desc')->get();

        return view('user.sections.transaction-logs.withdraw-log',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for view exchange log page
     * @return view
     */
    public function exchangeLog(){
        $page_title     = "- Exchange Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)->orderBy('id','desc')->get();

        return view('user.sections.transaction-logs.exchange-log',compact(
            'page_title',
            'transactions',
        ));
    }
}
