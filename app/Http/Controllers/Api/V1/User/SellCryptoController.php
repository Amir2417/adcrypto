<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Http\Helpers\Response;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;
use App\Models\Admin\CurrencyHasNetwork;
use App\Models\Admin\PaymentGatewayCurrency;

class SellCryptoController extends Controller
{
    /**
     * Method for store buy crypto index
     */
    public function index(Request $request){
        $user                           = auth()->user();
        $wallet_type                    = ['Inside Wallet','Outside Wallet'];
        $currencies                     = Currency::where('status',true)->orderBy('id')->get()->map(function($data){
            $networks                   = CurrencyHasNetwork::where('currency_id',$data->id)->get()->map(function($item){
                return [
                    'id'                => $item->id,
                    'currency_id'       => $item->currency_id,
                    'network_id'        => $item->network_id,
                    'name'              => $item->network->name,
                    'arrival_time'      => $item->network->arrival_time
                ];
            });
            
            return [
                'id'                    => $data->id,
                'name'                  => $data->name,
                'code'                  => $data->code,
                'symbol'                => $data->code,
                'flag'                  => $data->flag,
                'rate'                  => $data->rate,
                'networks'              => $networks,
            ];
        });

        $user_wallet        = UserWallet::where('user_id',$user->id)->get();
        $payment_gateway    = PaymentGatewayCurrency::whereHas('gateway', function ($gateway) {
            $gateway->where('slug', PaymentGatewayConst::money_out_slug());
            $gateway->where('status', 1);
        })->get();

        $image_paths = [
            'base_url'         => url("/"),
            'path_location'    => files_asset_path_basename("currency-flag"),
            'default_image'    => files_asset_path_basename("default"),

        ];

        $payment_image_paths = [
            'base_url'         => url("/"),
            'path_location'    => files_asset_path_basename("payment-gateways"),
            'default_image'    => files_asset_path_basename("default"),

        ];

        return Response::success([__("Sell Crypto Data")],[
            'wallet_type'           => $wallet_type,
            'currencies'            => $currencies,
            'user_wallet'           => $user_wallet,
            'payment_gateway'       => $payment_gateway,
            'currency_image_paths'           => $image_paths,
            'payment_image_paths'   => $payment_image_paths,
        ],200);
    }
}
