<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Models\UserWallet;

class ExchangeCryptoController extends Controller
{
    /**
     * Method for view exchange crypto page
     * @return view
     */
    public function index(){
        $page_title     = "- Exchange Crypto";
        $currencies     = UserWallet::with(['currency'])->get();
        

        return view('user.sections.exchange-crypto.index',compact(
            'page_title',
            'currencies'
        ));
    }
}
