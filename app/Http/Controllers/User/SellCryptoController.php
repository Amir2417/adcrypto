<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Helpers\Response;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\PaymentGatewayCurrency;

class SellCryptoController extends Controller
{
    /**
     * Method for view sell crypto page
     * @return view
     */
    public function index(){
        $page_title         = "- Sell Crypto";
        $currencies         = Currency::with(['networks'])->where('status',true)->orderBy('id')->get();
        $first_currency     = Currency::where('status',true)->first();
        $payment_gateway    = PaymentGatewayCurrency::whereHas('gateway', function ($gateway) {
            $gateway->where('slug', PaymentGatewayConst::payment_method_slug());
            $gateway->where('status', 1);
        })->get();
        
        return view('user.sections.sell-crypto.index',compact(
            'page_title',
            'currencies',
            'first_currency',
            'payment_gateway'
        ));
    }
    /**
     * Method for get networks
     * @param string $currency
     */
    public function getCurrencyNetworks(Request $request){
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
    /**
     * Method for store sell crypto data
     */
    public function store(Request $request){
        $validator      = Validator::make($request->all(),[
            ''
        ]);
    }
}
