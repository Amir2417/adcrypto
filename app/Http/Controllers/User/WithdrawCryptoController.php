<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Http\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\Admin\TransactionSetting;
use Illuminate\Support\Facades\Validator;

class WithdrawCryptoController extends Controller
{
    /**
     * Method for view withdraw crypto page
     * @return view
     */
    public function index(){
        $page_title         = "- Withdraw Crypto";
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
        $validator    = Validator::make($request->all(),[
            'wallet_address'  => 'required',           
        ]);
        if($validator->fails()) {
            return Response::error($validator->errors()->all());
        }
        $wallet_address     = $request->wallet_address;
        $wallet['data']     = UserWallet::with(['currency'])->where('public_address',$wallet_address)->first();
        $user               = UserWallet::auth()->where('public_address',$wallet_address)->first();

        if($wallet['data'] && @$user->public_address == @$wallet['data']->public_address){
            return response()->json(['own'=>'Can\'t withdraw/request to your own']);
        }
        return response($wallet);
        
    }
}
