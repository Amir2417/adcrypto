<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WithdrawCryptoController extends Controller
{
    /**
     * Method for view withdraw crypto page
     * @return view
     */
    public function index(){
        $page_title  = "- Sell Crypto";

        return view('user.sections.withdraw-crypto.index',compact(
            'page_title',
        ));
    }
}
