<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyCryptoController extends Controller
{
    /**
     * Method for view buy crypto page
     * @return view
     */
    public function index(){
        $page_title     = "- Buy Crypto";

        return view('user.sections.buy-crypto.index',compact(
            'page_title'
        ));
    }
}
