<?php

namespace App\Http\Controllers\User;

use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Models\Admin\Network;
use App\Http\Controllers\Controller;
use App\Models\Admin\CurrencyHasNetwork;

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
    /**
     * Method for wallet details
     * @param $public_address
     */
    public function walletDetails($public_address){
        $wallet     = UserWallet::with(['currency'])->where('public_address',$public_address)->first();
        if(!$wallet) return back()->with(['error' => ['Wallet not found!']]);
        $qr_code        = generateQr($wallet->public_address);
        
        $get_total_networks     = CurrencyHasNetwork::where('currency_id',$wallet->currency_id)->pluck('network_id');
        $network_names  = Network::whereIn('id',$get_total_networks)->pluck('name');
        
        return view('user.sections.wallet.details',compact(
                'wallet',
                'qr_code',
                'network_names'
        ));
    }
}