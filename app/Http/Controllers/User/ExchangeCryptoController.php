<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExchangeCryptoController extends Controller
{
    /**
     * Method for view exchange crypto page
     * @return view
     */
    public function index(){
        $page_title  = "- Exchange Crypto";

        return view('user.sections.exchange-crypto.index',compact(
            'page_title',
        ));
    }
}
