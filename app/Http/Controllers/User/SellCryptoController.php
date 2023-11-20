<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellCryptoController extends Controller
{
    /**
     * Method for view sell crypto page
     * @return view
     */
    public function index(){
        $page_title  = "- Sell Crypto";

        return view('user.sections.sell-crypto.index',compact(
            'page_title',
        ));
    }
}
