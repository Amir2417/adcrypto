<?php

namespace App\Http\Controllers\User;

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
use App\Models\Admin\PaymentGateway;
use Illuminate\Http\RedirectResponse;
use App\Constants\PaymentGatewayConst;
use App\Models\Admin\CurrencyHasNetwork;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\PaymentGatewayCurrency;
use App\Http\Helpers\PaymentGateway as PaymentGatewayHelper;

class BuyCryptoController extends Controller
{
    /**
     * Method for view buy crypto page
     * @return view
     */
    public function index(){
        $page_title         = "- Buy Crypto";
        $currencies         = Currency::with(['networks'])->where('status',true)->orderBy('id')->get();
        $first_currency     = Currency::where('status',true)->first();
        $payment_gateway    = PaymentGatewayCurrency::whereHas('gateway', function ($gateway) {
            $gateway->where('slug', PaymentGatewayConst::payment_method_slug());
            $gateway->where('status', 1);
        })->get();

        return view('user.sections.buy-crypto.index',compact(
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
     * Method for store the buy crypto information
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
                return back()->withErrors($validator)->withInput($request->all());
            }
            $validated          = $validator->validate();
            $wallet_currency    = $validated['sender_currency'];
            $amount             = $validated['amount'];

            $user_wallet  = UserWallet::auth()->whereHas("currency",function($q) use ($wallet_currency) {
                $q->where("id",$wallet_currency)->active();
            })->active()->first();

            if(!$user_wallet){
                return back()->with(['error' => ['Wallet not found!']]);
            }

            $network        = Network::where('id',$validated['network'])->first();
            $network_info   = CurrencyHasNetwork::where('currency_id',$user_wallet->currency->id)->where('network_id',$network->id)->first();
            
            $payment_gateway_currency   = PaymentGatewayCurrency::with(['gateway'])->where('id',$validated['payment_method'])->first();

            if(!$payment_gateway_currency){
                return back()->with(['error' => ['Payment Method not found!']]);
            }
            $rate           = $payment_gateway_currency->rate / $user_wallet->currency->rate;
            
            $min_max_rate   = $user_wallet->currency->rate / $payment_gateway_currency->rate;
            $min_amount     = $payment_gateway_currency->min_limit * $min_max_rate;
            $max_amount     = $payment_gateway_currency->max_limit * $min_max_rate;
            
            if($amount < $min_amount || $amount > $max_amount){
                return back()->with(['error' => ['Please follow the transaction limit.']]);
            }
            $fixed_charge   = ($payment_gateway_currency->fixed_charge) * $min_max_rate;
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
                        'name'          => $network->name,
                        'arrival_time'  => $network->arrival_time,
                        'fees'          => $network_info->fees,
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
                    'fixed_charge'      => $fixed_charge,
                    'percent_charge'    => $percent_charge,
                    'total_charge'      => $total_charge,
                    'payable_amount'    => $payable_amount,
                    'will_get'          => floatval($amount),
                ],
            ];
            try{
                $temporary_data = TemporaryData::create($data);
            }catch(Exception $e){
                return back()->with(['error' => ['Something went wrong! Please try again.']]);
            }
            return redirect()->route('user.buy.crypto.preview',$temporary_data->identifier);
        }

    }
    /**
     * Method for buy crypto preview page
     * @param $identifier
     * @param Illuminate\Http\Request $request
     */
    public function preview($identifier){
        $page_title     = "- Buy Crypto Preview";
        $data           = TemporaryData::where('identifier',$identifier)->first();
        if(!$data) return back()->with(['error' => ['Data not found!']]);
        return view('user.sections.buy-crypto.preview',compact(
            'page_title',
            'data'
        ));
    }
    /**
     * Method for buy crypto submit
     * @param Illuminate\Http\Request $request
     */
    public function submit(Request $request){
        
        try{
            $instance = PaymentGatewayHelper::init($request->all())->gateway()->render();
        }catch(Exception $e){
            dd($e->getMessage());
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }
        return $instance;
    }

    public function success(Request $request, $gateway){
    
        try{
            $token = PaymentGatewayHelper::getToken($request->all(),$gateway);
            $temp_data = TemporaryData::where("type",PaymentGatewayConst::BUY_CRYPTO)->where("identifier",$token)->first();
           

            if(Transaction::where('callback_ref', $token)->exists()) {
                if(!$temp_data) return redirect()->route('user.buy.crypto.index')->with(['success' => ['Transaction request sended successfully!']]);;
            }else {
                if(!$temp_data) return redirect()->route('user.buy.crypto.index')->with(['error' => ['Transaction failed. Record didn\'t saved properly. Please try again.']]);
            }

            $update_temp_data = json_decode(json_encode($temp_data->data),true);
            
            $update_temp_data['callback_data']  = $request->all();

            $temp_data->update([
                'data'  => $update_temp_data,
            ]);
            $temp_data = $temp_data->toArray();
            
            $instance = PaymentGatewayHelper::init($temp_data)->type(PaymentGatewayConst::BUY_CRYPTO)->setProjectCurrency(PaymentGatewayConst::PROJECT_CURRENCY_MULTIPLE)->responseReceive();
            if($instance instanceof RedirectResponse) return $instance;
        }catch(Exception $e) {
            return back()->with(['error' => [$e->getMessage()]]);
        }
        return redirect()->route("user.buy.crypto.index")->with(['success' => ['Successfully added money']]);
    }

    public function cancel(Request $request, $gateway) {

        if($request->has('token')) {
            $identifier = $request->token;
            if($temp_data = TemporaryData::where('identifier', $identifier)->first()) {
                $temp_data->delete();
            }
        }

        return redirect()->route('user.add.money.index');
    }

    public function callback(Request $request,$gateway) {

        $callback_token = $request->get('token');
        $callback_data = $request->all();

        try{
            PaymentGatewayHelper::init([])->type(PaymentGatewayConst::TYPEADDMONEY)->setProjectCurrency(PaymentGatewayConst::PROJECT_CURRENCY_SINGLE)->handleCallback($callback_token,$callback_data,$gateway);
        }catch(Exception $e) {
            // handle Error
            logger($e);
        }
    }

}
