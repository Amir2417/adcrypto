<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Method for view wallet page
     * @return view
     */
    public function index(){
        $page_title     = "- All Wallet";
        

        return view('user.sections.wallet.index',compact(
            'page_title'
        ));
    }
}
