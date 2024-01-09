<?php

namespace App\Http\Controllers\Api\V1\User;

use Exception;
use App\Models\UserWallet;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Network;
use App\Models\TemporaryData;
use App\Http\Helpers\Response;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Constants\PaymentGatewayConst;
use App\Models\Admin\CurrencyHasNetwork;
use App\Traits\ControlDynamicInputFields;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\PaymentGatewayCurrency;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\BuyCryptoManualMailNotification;
use App\Http\Helpers\PaymentGateway as PaymentGatewayHelper;

class BuyCryptoController extends Controller
{
    use ControlDynamicInputFields;
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
            $gateway->where('slug', PaymentGatewayConst::payment_method_slug());
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

        return Response::success([__("Buy Crypto Data")],[
            'wallet_type'           => $wallet_type,
            'currencies'            => $currencies,
            'user_wallet'           => $user_wallet,
            'payment_gateway'       => $payment_gateway,
            'image_paths'           => $image_paths,
            'payment_image_paths'   => $payment_image_paths,
        ],200);
    }
    /**
     * Method for store the buy crypto data
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request){
        if($request->wallet_type == global_const()::INSIDE_WALLET){
            $validator  = Validator::make($request->all(),[
                'sender_currency'   => 'required',
                'network'           => 'required',
                'amount'            => 'required',
                'payment_method'    => 'required'
            ]);
            if($validator->fails()){
                return Response::error($validator->errors()->all(),[]);
            }
            $validated            = $validator->validate();
            $wallet_currency    = $validated['sender_currency'];
            $amount             = $validated['amount'];

            $user_wallet  = UserWallet::auth()->whereHas("currency",function($q) use ($wallet_currency) {
                $q->where("id",$wallet_currency)->active();
            })->active()->first();
            
            
            if(!$user_wallet){
                return Response::error(['Wallet Not Found!'],[],404);
            }

            $network                    = CurrencyHasNetwork::where('currency_id',$wallet_currency)->where('network_id',$validated['network'])->first();
            if(!$network){
                return Response::error(['network Not Found!'],[],404);
            }
            $payment_gateway_currency   = PaymentGatewayCurrency::with(['gateway'])->where('id',$validated['payment_method'])->first();

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
            $fixed_charge   = $payment_gateway_currency->fixed_charge;
            $percent_charge = ($amount / 100) * $payment_gateway_currency->percent_charge;
            $total_charge   = $fixed_charge + $percent_charge;
            $payable_amount = ($amount * $rate) + $total_charge;
            $validated['identifier']    = Str::uuid();
            $data                       = [
                'type'                  => PaymentGatewayConst::BUY_CRYPTO,
                'identifier'            => $validated['identifier'],
                'data'                  => [
                    'wallet'            => [
                        'type'          => $request->wallet_type,
                        'wallet_id'     => $user_wallet->id,
                        'currency_id'   => $user_wallet->currency->id,
                        'name'          => $user_wallet->currency->name,
                        'code'          => $user_wallet->currency->code,
                        'rate'          => $user_wallet->currency->rate,
                        'balance'       => $user_wallet->balance,
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
                    'payable_amount'    => $payable_amount,
                    'will_get'          => floatval($amount),
                ],
            ];
            try{
                $temporary_data = TemporaryData::create($data);
            }catch(Exception $e){
                return Response::error(['Something went wrong! Please try again.'],[],404);
            }
            return Response::success([__("Buy Crypto Store Successfully.")],[
                'data'            => $temporary_data,
            ],200);
        }else{
            $validator  = Validator::make($request->all(),[
                'sender_currency'   => 'required',
                'network'           => 'required',
                'wallet_address'    => 'required',
                'amount'            => 'required',
                'payment_method'    => 'required'
            ]);
            if($validator->fails()){
                return Response::error($validator->errors()->all(),[]);
            }
            $validated          = $validator->validate();
            $wallet_currency    = $validated['sender_currency'];
            $amount             = $validated['amount'];

            $user_wallet  = UserWallet::auth()->whereHas("currency",function($q) use ($wallet_currency) {
                $q->where("id",$wallet_currency)->active();
            })->active()->first();

            if(!$user_wallet){
                return Response::error(['Wallet Not Found!'],[],404);
            }

            $network                    = CurrencyHasNetwork::where('currency_id',$wallet_currency)->where('network_id',$validated['network'])->first();
            if(!$network){
                return Response::error(['network Not Found!'],[],404);
            }
            
            $payment_gateway_currency   = PaymentGatewayCurrency::with(['gateway'])->where('id',$validated['payment_method'])->first();

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
            $fixed_charge   = $payment_gateway_currency->fixed_charge;
            $percent_charge = ($amount / 100) * $payment_gateway_currency->percent_charge;
            $total_charge   = $fixed_charge + $percent_charge;
            $payable_amount = ($amount * $rate) + $total_charge;
            
            $validated['identifier']    = Str::uuid();
            $data                       = [
                'type'                  => PaymentGatewayConst::BUY_CRYPTO,
                'identifier'            => $validated['identifier'],
                'data'                  => [
                    'wallet'            => [
                        'type'          => $request->wallet_type,
                        'wallet_id'     => $user_wallet->id,
                        'currency_id'   => $user_wallet->currency->id,
                        'name'          => $user_wallet->currency->name,
                        'code'          => $user_wallet->currency->code,
                        'rate'          => $user_wallet->currency->rate,
                        'address'       => $validated['wallet_address'],
                        'balance'       => $user_wallet->balance,
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
                    'payable_amount'    => $payable_amount,
                    'will_get'          => floatval($amount),
                ],
            ];
            try{
                $temporary_data = TemporaryData::create($data);
            }catch(Exception $e){
                return Response::error(['Something went wrong! Please try again.'],[],404);
            }
            return Response::success([__("Buy Crypto Store Successfully.")],[
                'data'            => $temporary_data,
            ],200);
        }
    }
    /**
     * Method for buy crypto submit
     * @param Illuminate\Http\Request $request
     */
    public function submit(Request $request){
        try{
            $instance = PaymentGatewayHelper::init($request->all())->type(PaymentGatewayConst::BUY_CRYPTO)->gateway()->api()->render();
        }catch(Exception $e) {
            return Response::error([$e->getMessage()],[],500);
        }

        if($instance instanceof RedirectResponse === false && isset($instance['gateway_type']) && $instance['gateway_type'] == PaymentGatewayConst::MANUAL) {
            return Response::error([__('Can\'t submit manual gateway in automatic link')],[],400);
        }

        return Response::success([__('Payment gateway response successful')],[
            'redirect_url'          => $instance['redirect_url'],
            'redirect_links'        => $instance['redirect_links'],
            'action_type'           => $instance['type']  ?? false, 
            'address_info'          => $instance['address_info'] ?? [],
        ],200); 
    }
    public function success(Request $request, $gateway){
        try{
            $token = PaymentGatewayHelper::getToken($request->all(),$gateway);
            $temp_data = TemporaryData::where("identifier",$token)->first();

            if(!$temp_data) {
                if(Transaction::where('callback_ref',$token)->exists()) {
                    return Response::success([__('Transaction request sended successfully!')],[],400);
                }else {
                    return Response::error([__('Transaction failed. Record didn\'t saved properly. Please try again')],[],400);
                }
            }

            $update_temp_data = json_decode(json_encode($temp_data->data),true);
            $update_temp_data['callback_data']  = $request->all();
            $temp_data->update([
                'data'  => $update_temp_data,
            ]);
            $temp_data = $temp_data->toArray();
            $instance = PaymentGatewayHelper::init($temp_data)->type(PaymentGatewayConst::BUY_CRYPTO)->responseReceive();

            if($instance instanceof RedirectResponse) return $instance;
        }catch(Exception $e) {
            
            return Response::error([$e->getMessage()],[],500);
        }
        
        return Response::success(["Payment successful, please go back your app"],200);

        
    }

    public function cancel(Request $request,$gateway) {
        $token = PaymentGatewayHelper::getToken($request->all(),$gateway);
        $temp_data = TemporaryData::where("identifier",$token)->first();
        try{
            if($temp_data != null) {
                $temp_data->delete();
            }
        }catch(Exception $e) {
            // Handel error
        }
        return Response::success([__('Payment process cancel successfully!')],[],200);
    }
}
