<?php

namespace App\Http\Controllers\Api\V1\User;

use Exception;
use App\Models\UserWallet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Network;
use App\Models\TemporaryData;
use App\Http\Helpers\Response;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;
use App\Models\Admin\CurrencyHasNetwork;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\OutsideWalletAddress;
use App\Models\Admin\PaymentGatewayCurrency;
use Illuminate\Validation\ValidationException;

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

        $outside_wallet_address     = OutsideWalletAddress::orderBy('id')->get();

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
            'wallet_type'                   => $wallet_type,
            'outside_wallet_address'        => $outside_wallet_address,
            'currencies'                    => $currencies,
            'user_wallet'                   => $user_wallet,
            'payment_gateway'               => $payment_gateway,
            'currency_image_paths'          => $image_paths,
            'payment_image_paths'           => $payment_image_paths,
        ],200);
    }
    /**
     * Method for store sell crypto information
     */
    public function store(Request $request){
        if($request->wallet_type == global_const()::INSIDE_WALLET){
            $validator           = Validator::make($request->all(),[
                'wallet_type'       => 'required',
                'sender_currency'   => 'required',
                'network'           => 'required',
                'amount'            => 'required',
                'payment_method'    => 'required',
            ]);
            if($validator->fails()) return Response::error($validator->errors()->all(),[]);

            $validated          = $validator->validate();
            $amount             = $validated['amount'];
            $wallet_currency    = $validated['sender_currency'];
            
            $user_wallet        = UserWallet::auth()->whereHas("currency",function($q) use($wallet_currency) {
                $q->where("currency_id",$wallet_currency)->active();
            })->active()->first();
            
            if(!$user_wallet) return Response::error(['Wallet not found!'],[],404);
            
            if($amount > $user_wallet->balance){
                return Response::error(['Sorry! Insufficient Balance.'],[],404);
            }
            
            $network                    = CurrencyHasNetwork::where('currency_id',$wallet_currency)->where('network_id',$validated['network'])->first();
            if(!$network){
                return Response::error(['network Not Found!'],[],404);
            }
            
            
            $payment_gateway_currency   = PaymentGatewayCurrency::where('id',$validated['payment_method'])->whereHas('gateway', function ($gateway) {
                $gateway->where('slug', PaymentGatewayConst::money_out_slug())->where('status', 1);
            })->first();

            
            if(!$payment_gateway_currency){
                return Response::error(['Payment Method Not Found!'],[],404);
            }
           
            $rate           = $payment_gateway_currency->rate / $user_wallet->currency->rate;
            
            $min_max_rate   = $user_wallet->currency->rate / $payment_gateway_currency->rate;
            $min_amount     = $payment_gateway_currency->min_limit * $min_max_rate;
            $max_amount     = $payment_gateway_currency->max_limit * $min_max_rate;
            if($amount < $min_amount || $amount > $max_amount){
                return Response::error(['Please follow the transaction limit.'],[],404);
            }
            $fixed_charge   = ($payment_gateway_currency->fixed_charge) * $min_max_rate;
            $percent_charge = ($amount / 100) * $payment_gateway_currency->percent_charge;
            $total_charge   = $fixed_charge + $percent_charge;
            $payable_amount = $amount + $total_charge;
            $will_get       = $amount * $rate;
            if($payable_amount > $user_wallet->balance){
                return Response::error(['Sorry! Insufficient Balance.'],[],404);
            }

            $data                       = [
                'type'                  => PaymentGatewayConst::SELL_CRYPTO,
                'identifier'            => Str::uuid(),
                'data'                  => [
                    'sender_wallet'     => [
                        'type'          => $request->wallet_type,
                        'wallet_id'     => $user_wallet->id,
                        'currency_id'   => $user_wallet->currency->id,
                        'name'          => $user_wallet->currency->name,
                        'code'          => $user_wallet->currency->code,
                        'rate'          => floatval($user_wallet->currency->rate),
                        'balance'       => floatval($user_wallet->balance),
                    ],
                    'network'           => [
                        'name'          => $network->network->name,
                        'arrival_time'  => $network->network->arrival_time,
                        'fees'          => $network->fees,
                    ],
                    'payment_method'    => [
                        'id'            => $payment_gateway_currency->id,
                        'name'          => $payment_gateway_currency->name,
                        'code'          => $payment_gateway_currency->currency_code,
                        'alias'         => $payment_gateway_currency->alias,
                        'rate'          => $payment_gateway_currency->rate,
                    ],
                    'amount'            => floatval($amount),
                    'exchange_rate'     => $rate,
                    'min_max_rate'      => $min_max_rate,
                    'fixed_charge'      => floatval($fixed_charge),
                    'percent_charge'    => $percent_charge,
                    'total_charge'      => $total_charge,
                    'total_payable'     => $payable_amount,
                    'will_get'          => floatval($will_get),
                ]
            ];
        
            try{
                $temporary_data         = TemporaryData::create($data);
            }catch(Exception $e){
                return Response::error(['Something went wrong! Please try again.'],[],404);
            }
            return Response::success([__("Sell Crypto Store Successfully using Inside Wallet.")],[
                'data'                      => $temporary_data,
                'payment_gateway_fields'    => $payment_gateway_currency->gateway->input_fields
            ],200);
        }else{
            $validator           = Validator::make($request->all(),[
                'wallet_type'       => 'required',
                'sender_currency'   => 'required',
                'network'           => 'required',
                'amount'            => 'required',
                'payment_method'    => 'required',
            ]);
            if($validator->fails()) return Response::error($validator->errors()->all(),[]);

            $validated          = $validator->validate();
            $amount             = $validated['amount'];
            $wallet_currency    = $validated['sender_currency'];

            if (!OutsideWalletAddress::where('currency_id', $validated['sender_currency'])
                ->where('network_id', $validated['network'])
                ->exists()) {
                throw ValidationException::withMessages([
                    'name'  => "Outside Wallet is not available for this coin and network.",
                ]);
            }
            
            $outside_address    = OutsideWalletAddress::where('currency_id', $validated['sender_currency'])
            ->where('network_id', $validated['network'])->where('status',true)->first();
            

            $user_wallet        = UserWallet::auth()->whereHas("currency",function($q) use($wallet_currency) {
                $q->where("currency_id",$wallet_currency)->active();
            })->active()->first();
            
            
            $network                    = CurrencyHasNetwork::where('currency_id',$wallet_currency)->where('network_id',$validated['network'])->first();
            if(!$network){
                return Response::error(['network Not Found!'],[],404);
            }
            
            $payment_gateway_currency   = PaymentGatewayCurrency::where('id',$validated['payment_method'])->whereHas('gateway', function ($gateway) {
                $gateway->where('slug', PaymentGatewayConst::money_out_slug())->where('status', 1);
            })->first();

            if(!$payment_gateway_currency){
                return Response::error(['Payment Method Not Found!'],[],404);
            }
            $rate           = $payment_gateway_currency->rate / $user_wallet->currency->rate;
            
            $min_max_rate   = $user_wallet->currency->rate / $payment_gateway_currency->rate;
            $min_amount     = $payment_gateway_currency->min_limit * $min_max_rate;
            $max_amount     = $payment_gateway_currency->max_limit * $min_max_rate;
            if($amount < $min_amount || $amount > $max_amount){
                return Response::error(['Please follow the transaction limit.'],[],404);
            }
            $fixed_charge   = ($payment_gateway_currency->fixed_charge) * $min_max_rate;
            $percent_charge = ($amount / 100) * $payment_gateway_currency->percent_charge;
            $total_charge   = $fixed_charge + $percent_charge;
            $payable_amount = $amount + $total_charge;
            $will_get       = $amount * $rate;
            

            $data                       = [
                'type'                  => PaymentGatewayConst::SELL_CRYPTO,
                'identifier'            => Str::uuid(),
                'data'                  => [
                    'sender_wallet'     => [
                        'type'          => $request->wallet_type,
                        'wallet_id'     => $user_wallet->id,
                        'currency_id'   => $user_wallet->currency->id,
                        'name'          => $user_wallet->currency->name,
                        'code'          => $user_wallet->currency->code,
                        'rate'          => floatval($user_wallet->currency->rate),
                        'balance'       => floatval($user_wallet->balance),
                    ],
                    'network'           => [
                        'name'          => $network->network->name,
                        'arrival_time'  => $network->network->arrival_time,
                        'fees'          => $network->fees,
                    ],
                    'payment_method'    => [
                        'id'            => $payment_gateway_currency->id,
                        'name'          => $payment_gateway_currency->name,
                        'code'          => $payment_gateway_currency->currency_code,
                        'alias'         => $payment_gateway_currency->alias,
                        'rate'          => $payment_gateway_currency->rate,
                    ],
                    'amount'            => floatval($amount),
                    'exchange_rate'     => $rate,
                    'min_max_rate'      => $min_max_rate,
                    'fixed_charge'      => floatval($fixed_charge),
                    'percent_charge'    => $percent_charge,
                    'total_charge'      => $total_charge,
                    'total_payable'     => $payable_amount,
                    'will_get'          => floatval($will_get),
                ]
            ];
        
            try{
                $temporary_data         = TemporaryData::create($data);
            }catch(Exception $e){
                return Response::error(['Something went wrong! Please try again.'],[],404);
            }
            return Response::success([__("Sell Crypto Store Successfully using Outside Wallet.")],[
                'data'                      => $temporary_data,
                'payment_gateway_fields'    => $payment_gateway_currency->gateway->input_fields,
                'payment_proof_fields'      => $outside_address->input_fields
            ],200);
        }
    }
    
}
