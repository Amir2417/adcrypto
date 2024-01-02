<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Helpers\Response;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\OutsideWalletAddress;

class OutsideWalletAddressController extends Controller
{
    /**
     * Method for outside wallet index page
     * @return view
     */
    public function index(){
        $page_title         = "Outside Wallet Payment Receiving Address";
        $outside_wallets    = OutsideWalletAddress::orderBy('id','desc')->get();

        return view('admin.sections.outside-wallet.index',compact(
            'page_title',
            'outside_wallets'
        ));
    }
    /**
     * Method for outside wallet create page
     * @return view
     */
    public function create(){
        $page_title         = "Outside Wallet Create";
        $currencies         = Currency::with(['networks'])->where('status',true)->orderBy('id')->get();
        
        return view('admin.sections.outside-wallet.create',compact(
            'page_title',
            'currencies'
        ));
    } 
    /**
     * Method for get all Networks based on Currency
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function getNetworks(Request $request) {

        $validator    = Validator::make($request->all(),[
            'currency'  => 'required|integer',           
        ]);
        if($validator->fails()) {
            return Response::error($validator->errors()->all());
        }

        $currency  = Currency::with(['networks' => function($network) {
            $network->with(['network']);
        }])->find($request->currency);
        if(!$currency) return Response::error(['Currency Not Found'],404);

        return Response::success(['Data fetch successfully'],['currency' => $currency],200);
    }
}
