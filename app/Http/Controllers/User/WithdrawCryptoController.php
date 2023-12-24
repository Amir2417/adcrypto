<?php

namespace App\Http\Controllers\User;

use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\TransactionSetting;

class WithdrawCryptoController extends Controller
{
    /**
     * Method for view withdraw crypto page
     * @return view
     */
    public function index(){
        $page_title         = "- Sell Crypto";
        $currencies         = UserWallet::auth()->with(['currency'])->get();
        $transaction_fees   = TransactionSetting::where('slug','withdraw')->first();

        return view('user.sections.withdraw-crypto.index',compact(
            'page_title',
            'currencies',
            'transaction_fees'
        ));
    }
    /**
     * Method for check wallet address
     */
    public function checkWalletAddress(Request $request){
        dd($request->all());
    }
}
