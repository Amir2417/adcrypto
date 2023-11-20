<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Method for view buy log page
     * @return view
     */
    public function buyLog(){
        $page_title  = "- Buy Logs";

        return view('user.sections.transaction-logs.buy-log',compact(
            'page_title',
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
        $page_title  = "- Withdraw Logs";

        return view('user.sections.transaction-logs.withdraw-log',compact(
            'page_title',
        ));
    }
    /**
     * Method for view exchange log page
     * @return view
     */
    public function exchangeLog(){
        $page_title  = "- Exchange Logs";

        return view('user.sections.transaction-logs.exchange-log',compact(
            'page_title',
        ));
    }
}
