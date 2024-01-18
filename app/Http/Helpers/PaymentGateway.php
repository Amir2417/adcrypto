<?php
namespace App\Http\Helpers;

use Exception;
use App\Models\UserWallet;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\TemporaryData;
use App\Constants\GlobalConst;
use App\Models\Admin\Currency;
use App\Models\UserNotification;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\BasicSettings;
use App\Traits\PaymentGateway\Gpay;
use App\Traits\PaymentGateway\QRPay;
use App\Traits\PaymentGateway\Tatum;
use Illuminate\Support\Facades\Auth;
use App\Traits\PaymentGateway\Paypal;
use App\Traits\PaymentGateway\Stripe;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Route;
use App\Constants\PaymentGatewayConst;
use App\Traits\PaymentGateway\CoinGate;
use App\Traits\PaymentGateway\Razorpay;
use App\Providers\Admin\CurrencyProvider;
use App\Traits\PaymentGateway\SslCommerz;
use Illuminate\Support\Facades\Validator;
use App\Traits\PaymentGateway\Flutterwave;
use App\Traits\PaymentGateway\PerfectMoney;
use App\Models\Admin\PaymentGatewayCurrency;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use App\Notifications\User\BuyCryptoMailNotification;
use App\Models\Admin\PaymentGateway as PaymentGatewayModel;

class PaymentGateway {

    use Paypal, Gpay, CoinGate, QRPay, Tatum, Stripe, Flutterwave, SslCommerz, Razorpay,PerfectMoney;

    protected $request_data;
    protected $output;
    protected $currency_input_name = "identifier";
    protected $project_currency = PaymentGatewayConst::PROJECT_CURRENCY_MULTIPLE;
    protected $predefined_user_wallet;
    protected $predefined_guard;
    protected $predefined_user;

    public function __construct(array $request_data)
    {
        $this->request_data = $request_data;
    }

    public static function init(array $data) {
        return new PaymentGateway($data);
    }

    public function setProjectCurrency(string $type) {
        
        $this->project_currency = $type;
        return $this;
    }

    public function gateway() {
        $request_data = $this->request_data;
        
        if(empty($request_data)) throw new Exception("Gateway Information is not available. Please provide payment gateway currency alias");
        $validated = $this->validator($request_data)->validate();
        $temporary_data     = TemporaryData::where('identifier',$validated['identifier'])->first();
        $gateway_currency   = PaymentGatewayCurrency::with(['gateway'])->where("alias",$temporary_data->data->payment_method->alias)->first();
        $wallet_currency   = UserWallet::with(['currency'])->where('id',$temporary_data->data->wallet->wallet_id)->first();
        
        
        if(!$gateway_currency || !$gateway_currency->gateway) {
            if(request()->acceptsJson()) throw new Exception("Gateway not available");
            throw ValidationException::withMessages([
                $this->currency_input_name = "Gateway not available",
            ]);
        }
        
        if($this->project_currency == PaymentGatewayConst::PROJECT_CURRENCY_SINGLE) {
            $default_currency = CurrencyProvider::default();
            
            if(!$default_currency) throw new Exception("Project currency does not have default value.");
            $this->output['wallet']             = $this->getUserWallet($default_currency);
        }else {
            $this->output['wallet']             = $this->getUserWallet($wallet_currency);
        }
        
        $this->output['gateway']            = $gateway_currency->gateway;
        $this->output['currency']           = $gateway_currency;
        $this->output['sender_currency']    = $wallet_currency->currency;
        $this->output['amount']             = $this->amount();
        $this->output['form_data']          = $this->request_data;
       
        if($gateway_currency->gateway->isAutomatic()) {
            
            $this->output['distribute']         = $this->gatewayDistribute($gateway_currency->gateway);
            $this->output['record_handler']     = $this->generateRecordHandler();
        }else {
            
            $this->output['distribute']         = "handleManualPayment";
            $this->output['gateway_type']       = PaymentGatewayConst::MANUAL;
        }
        // limit validation
        $this->limitValidation($this->output);

        return $this;
    }

    public function generateRecordHandler() {
        
        if($this->predefined_guard) {
            $guard = $this->predefined_guard;
        }else {
            $guard = get_auth_guard();
        }

        $method = "insertRecord". ucwords($guard);
       
        return $method;
    }

    public function getUserWallet($wallet_currency) {

        if($this->predefined_user_wallet) return $this->predefined_user_wallet;

        $guard = get_auth_guard();
        
        $register_wallets = PaymentGatewayConst::registerWallet();
        
        if(!array_key_exists($guard,$register_wallets)) {
            throw new Exception("Wallet Not Registered. Please register user wallet in PaymentGatewayConst::class with user guard name");
        }
        $wallet_model = $register_wallets[$guard];
        
        $user_wallet = $wallet_model::auth()->where("id",$wallet_currency->id)->first();
        

        if(!$user_wallet) {
            if(request()->acceptsJson()) throw new Exception("Wallet not found!");
            throw ValidationException::withMessages([
                $this->currency_input_name = "Wallet not found!",
            ]);
        }
        
        return $user_wallet;
    }

    public function validator($data) {
        $validator = Validator::make($data,[
            'identifier'  => "required",
        ]);

        if(request()->acceptsJson()) {
            if($validator->fails()) {
                $errors = $validator->errors()->all();
                $first_error = $errors[0];
                throw new Exception($first_error);
            }
        }

        return $validator;
    }

    public function limitValidation($output) {
        $gateway_currency = $output['currency'];
        
        $requested_amount = $output['amount']->requested_amount;

        $min_limit = $gateway_currency->min_limit * $output['amount']->min_max_rate;
        $max_limit = $gateway_currency->max_limit * $output['amount']->min_max_rate;

        if($requested_amount < $min_limit || $requested_amount > $max_limit) {
            if(request()->acceptsJson()) throw new Exception("Please follow the transaction limit");
            throw ValidationException::withMessages([
                "Please follow the transaction limit",
            ]);
        }
    }

    public function get() {
        return $this->output;
    }

    public function gatewayDistribute($gateway = null) {
        
        if(!$gateway) $gateway = $this->output['gateway'];
        $alias = Str::lower($gateway->alias);
        $method = PaymentGatewayConst::register($alias);
        
        if(method_exists($this,$method)) {
            
            return $method;
        }
        throw new Exception("Gateway(".$gateway->name.") Trait or Method (".$method."()) does not exists");
    }

    public function amount() {
        $currency = $this->output['currency'] ?? null;
        
        if(!$currency) throw new Exception("Gateway currency not found");
        return $this->chargeCalculate($currency);
    }

    public function chargeCalculate($currency,$receiver_currency = null) {
        $temporary_data     = TemporaryData::where('identifier',$this->request_data['identifier'])->first();
        
        if($this->predefined_user_wallet) {
            $user_wallet = $this->predefined_user_wallet;
        }else{
            $user_wallet    =  UserWallet::auth()->where("id",$temporary_data->data->wallet->wallet_id)->first();
        } 
        
        
        $amount = $temporary_data->data->amount;
        
        $sender_currency_rate = $currency->rate / $user_wallet->currency->rate;
        $min_max_rate   = $user_wallet->currency->rate / $currency->rate;
        
        ($sender_currency_rate == "" || $sender_currency_rate == null) ? $sender_currency_rate = 0 : $sender_currency_rate;
        ($amount == "" || $amount == null) ? $amount : $amount;

        if($currency != null) {
            $fixed_charges = $currency->fixed_charge;
            $percent_charges = $currency->percent_charge;
        }else {
            $fixed_charges = 0;
            $percent_charges = 0;
        }

        $fixed_charge_calc = $fixed_charges;
        
        $percent_charge_calc = ($amount / 100 ) * $percent_charges;

        $total_charge = $fixed_charge_calc + $percent_charge_calc;
        
        if($receiver_currency) {
            $receiver_currency_rate = $receiver_currency->rate;
            ($receiver_currency_rate == "" || $receiver_currency_rate == null) ? $receiver_currency_rate = 0 : $receiver_currency_rate;
            $exchange_rate = ($receiver_currency_rate / $sender_currency_rate);
            $will_get = ($amount * $exchange_rate);

            $data = [
                'requested_amount'          => $amount,
                'sender_cur_code'           => $currency->currency_code,
                'sender_cur_rate'           => $sender_currency_rate ?? 0,
                'receiver_cur_code'         => $receiver_currency->currency_code,
                'receiver_cur_rate'         => $receiver_currency->rate ?? 0,
                'fixed_charge'              => $fixed_charge_calc,
                'percent_charge'            => $percent_charge_calc,
                'total_charge'              => $total_charge,
                'total_amount'              => $amount + $total_charge,
                'exchange_rate'             => $exchange_rate,
                'will_get'                  => $will_get,
                'default_currency'          => get_default_currency_code(),
            ];

        }else if($this->project_currency == PaymentGatewayConst::PROJECT_CURRENCY_SINGLE){
            
            $exchange_rate = $sender_currency_rate;
            $will_get = $amount;

            $fixed_charge_calc = $fixed_charges;
            $percent_charge_calc = ((($amount * $exchange_rate) / 100 ) * $percent_charges) / $exchange_rate;

            $total_charge = $fixed_charge_calc + $percent_charge_calc;
            $total_amount = ($amount * $exchange_rate) + ($total_charge * $exchange_rate);

            $data = [
                'requested_amount'          => $amount,
                'sender_cur_code'           => $currency->currency_code,
                'sender_cur_rate'           => $sender_currency_rate ?? 0,
                'fixed_charge'              => $fixed_charge_calc,
                'percent_charge'            => $percent_charge_calc,
                'total_charge'              => $total_charge,
                'total_amount'              => $total_amount, // receive payment from gateway
                'exchange_rate'             => $exchange_rate,
                'will_get'                  => $will_get,
                'default_currency'          => get_default_currency_code(),
            ];
        }else {
            
            $exchange_rate = $sender_currency_rate;
            $will_get = $amount;

            $data = [
                'requested_amount'          => $amount,
                'sender_cur_code'           => $currency->currency_code,
                'sender_cur_rate'           => $sender_currency_rate ?? 0,
                'wallet_cur_code'           => $user_wallet->currency->code ?? 0,
                'wallet_cur_rate'           => $user_wallet->currency->rate ?? 0,
                'fixed_charge'              => $fixed_charge_calc,
                'percent_charge'            => $percent_charge_calc,
                'total_charge'              => $total_charge,
                'total_amount'              => ($amount * $sender_currency_rate) + $total_charge,
                'exchange_rate'             => $exchange_rate,
                'will_get'                  => $will_get,
                'min_max_rate'              => $min_max_rate,
                'default_currency'          => get_default_currency_code(),
            ];
            
        }
        

        return (object) $data;
    }

    public function render() {
        $output = $this->output;
        if(isset($output['gateway_type']) && $output['gateway_type'] == PaymentGatewayConst::MANUAL) {
            return $this->get();
        }

        if(!is_array($output)) throw new Exception("Render Failed! Please call with valid gateway/credentials");

        $common_keys = ['gateway','currency','amount','distribute'];
        foreach($output as $key => $item) {
            if(!array_key_exists($key,$common_keys)) {
                $this->gateway();
                break;
            }
        }

        $distributeMethod = $this->output['distribute'];
        if(!method_exists($this,$distributeMethod)) throw new Exception("Something went wrong! Please try again.");
        return $this->$distributeMethod($output);
    }

    public function responseReceive() {
        $tempData = $this->request_data;
        
        if(empty($tempData) || empty($tempData['type'])) throw new Exception('Transaction failed. Record didn\'t saved properly. Please try again.');

        if($this->requestIsApiUser()) {
            $creator_table = $tempData['data']->creator_table ?? null;
            $creator_id = $tempData['data']->creator_id ?? null;
            $creator_guard = $tempData['data']->creator_guard ?? null;

            $api_authenticated_guards = PaymentGatewayConst::apiAuthenticateGuard();
            if(!array_key_exists($creator_guard,$api_authenticated_guards)) throw new Exception('Request user doesn\'t save properly. Please try again');

            if($creator_table == null || $creator_id == null || $creator_guard == null) throw new Exception('Request user doesn\'t save properly. Please try again');
            $creator = DB::table($creator_table)->where("id",$creator_id)->first();
            if(!$creator) throw new Exception("Request user doesn\'t save properly. Please try again");

            $api_user_login_guard = $api_authenticated_guards[$creator_guard];
            $this->output['api_login_guard'] = $api_user_login_guard;
            Auth::guard($api_user_login_guard)->loginUsingId($creator->id);
        }
        
        $currency_id = $tempData['data']->currency ?? "";
        $gateway_currency = PaymentGatewayCurrency::find($currency_id);
        if(!$gateway_currency) throw new Exception('Transaction failed. Gateway currency not available.');
        $requested_amount = $tempData['data']->amount->requested_amount ?? 0;
        
        $validator_data = [
            'identifier'  => $tempData['data']->user_record,
        ];
        
        $this->request_data = $validator_data;
        $this->gateway();
        
        $this->output['tempData'] = $tempData;
        $method_name = $this->getResponseMethod($this->output['gateway']);
        
        if(method_exists($this,$method_name)) {
            return $this->$method_name($this->output);
        }
        throw new Exception("Response method ".$method_name."() does not exists.");
    }

    public function type($type) {
        $this->output['type']  = $type;
        return $this;
    }

    public function getRedirection() {
        $redirection = PaymentGatewayConst::registerRedirection();
        $guard = get_auth_guard();
        if(!array_key_exists($guard,$redirection)) {
            throw new Exception("Gateway Redirection URLs/Route Not Registered. Please Register in PaymentGatewayConst::class");
        }
        $gateway_redirect_route = $redirection[$guard];
        return $gateway_redirect_route;
    }

    public static function getToken(array $response, string $gateway) {
        switch($gateway) {
            case PaymentGatewayConst::PAYPAL:
                return $response['token'] ?? "";
                break;
            case PaymentGatewayConst::G_PAY:
                return $response['gpay_trans_id'] ?? "";
                break;
            case PaymentGatewayConst::COIN_GATE:
                return $response['token'] ?? "";
                break;
            case PaymentGatewayConst::QRPAY:
                return $response['token'] ?? "";
                break;
            case PaymentGatewayConst::STRIPE:
                return $response['token'] ?? "";
                break;
            case PaymentGatewayConst::FLUTTERWAVE:
                return $response['token'] ?? "";
                break;
            case PaymentGatewayConst::RAZORPAY:
                return $response['token'] ?? "";
                break;
            case PaymentGatewayConst::SSLCOMMERZ:
                    return $response['token'] ?? "";
                    break;
            case PaymentGatewayConst::PERFECT_MONEY:
                        return $response['PAYMENT_ID'] ?? "";
                        break;
            default:
                throw new Exception("Oops! Gateway not registered in getToken method");
        }
        throw new Exception("Gateway token not found!");
    }

    public function getResponseMethod($gateway) {

        $gateway_is = PaymentGatewayConst::registerGatewayRecognization();

        foreach($gateway_is as $method => $gateway_name) {
            if(method_exists($this,$method)) {
                if($this->$method($gateway)) {
                    return $this->generateSuccessMethodName($gateway_name);
                    break;
                }
            }
        }
        throw new Exception("Payment gateway response method not declared in generateResponseMethod");
    }

    public function getCallbackResponseMethod($gateway) {

        $gateway_is = PaymentGatewayConst::registerGatewayRecognization();
        foreach($gateway_is as $method => $gateway_name) {
            if(method_exists($this,$method)) {
                if($this->$method($gateway)) {
                    return $this->generateCallbackMethodName($gateway_name);
                    break;
                }
            }
        }

    }

    public function generateCallbackMethodName(string $name) {
        return $name . "CallbackResponse";
    }

    public function generateSuccessMethodName(string $name) {
        return $name . "Success";
    }

    // Update Code (Need to check)
    public function createTransaction($output, $status) {
        
        $basic_setting = BasicSettings::first();
        $record_handler = $output['record_handler'];
        if($this->predefined_user) {
            $user = $this->predefined_user;
        }else {
            $user = auth()->guard(get_auth_guard())->user();
        }
        $inserted_id = $this->$record_handler($output,$status);
        $trx_id     = Transaction::where('id',$inserted_id)->first();
        // $this->insertCharges($output,$inserted_id);
        $data = TemporaryData::where('identifier',$output['form_data']['identifier'])->first();
        UserNotification::create([
            'user_id'       => $user->id,
            'message'       => [
                'title'     => "Buy Crypto",
                'payment'   => $data->data->payment_method->name,
                'wallet'    => $data->data->wallet->name,
                'code'      => $data->data->wallet->code,
                'amount'    => $data->data->amount,
                'status'    => $trx_id->status,
                'success'   => "Successfully Added."
            ],
        ]);
        
        
        if($basic_setting->email_notification == true){
           Notification::route("mail",$user->email)->notify(new BuyCryptoMailNotification($user,$output,$trx_id->trx_id));
        }

        $this->insertDevice($output,$inserted_id);
        $this->removeTempData($output);

        if($this->requestIsApiUser()) {
            // logout user
            $api_user_login_guard = $this->output['api_login_guard'] ?? null;
            if($api_user_login_guard != null) {
                auth()->guard($api_user_login_guard)->logout();
            }
        }
        
    }

    

    public function insertRecordWeb($output, $status) {
        
        $data  = TemporaryData::where('identifier',$output['form_data']['identifier'])->first();
        if($this->predefined_user) {
            $user = $this->predefined_user;
        }else {
            $user = auth()->guard('web')->user();
        }

        $trx_id = generateTrxString("transactions","trx_id","BC",8);
       
        DB::beginTransaction();
        try{
            $id = DB::table("transactions")->insertGetId([
                'type'                          => $output['type'],
                'user_id'                       => $user->id,
                'user_wallet_id'                => $output['wallet']->id,
                'payment_gateway_id'            => $output['currency']->id,
                'trx_id'                        => $trx_id,
                'amount'                        => $output['amount']->requested_amount,
                'percent_charge'                => $output['amount']->percent_charge,
                'fixed_charge'                  => $output['amount']->fixed_charge,
                'total_charge'                  => $output['amount']->total_charge,
                'total_payable'                 => $output['amount']->total_amount,
                'available_balance'             => $output['wallet']->balance + $output['amount']->requested_amount,
                'currency_code'                 => $output['currency']->currency_code,
                'remark'                        => ucwords(remove_special_char($output['type']," ")) . " With " . $output['gateway']->name,
                'details'                       => json_encode(['gateway_response' => $output['capture'],'data' => $data->data,'user_record' => $output['form_data']['identifier']]),
                'status'                        => $status,
                'callback_ref'                  => $output['callback_ref'] ?? null,
                'created_at'                    => now(),
            ]);

            if($status === global_const()::STATUS_CONFIRM_PAYMENT) {
                $this->updateWalletBalance($output);
            }

            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        return $id;
    }

    public function updateWalletBalance($output) {
        $update_amount = $output['wallet']->balance + $output['amount']->requested_amount;

        $output['wallet']->update([
            'balance'   => $update_amount,
        ]);
    }

    public function insertCharges($output,$id) {
        DB::beginTransaction();
        try{
            DB::table('transaction_charges')->insert([
                'transaction_id'    => $id,
                'percent_charge'    => $output['amount']->percent_charge,
                'fixed_charge'      => $output['amount']->fixed_charge,
                'total_charge'      => $output['amount']->total_charge,
                'created_at'        => now(),
            ]);
            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function insertDevice($output,$id) {
        $client_ip = request()->ip() ?? false;
        $location = geoip()->getLocation($client_ip);
        $agent = new Agent();


        $mac = "";

        DB::beginTransaction();
        try{
            DB::table("transaction_devices")->insert([
                'transaction_id'=> $id,
                'ip'            => $client_ip,
                'mac'           => $mac,
                'city'          => $location['city'] ?? "",
                'country'       => $location['country'] ?? "",
                'longitude'     => $location['lon'] ?? "",
                'latitude'      => $location['lat'] ?? "",
                'timezone'      => $location['timezone'] ?? "",
                'browser'       => $agent->browser() ?? "",
                'os'            => $agent->platform() ?? "",
            ]);
            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function removeTempData($output) {
        try{
            $id = $output['tempData']['id'];
            TemporaryData::find($id)->delete();
        }catch(Exception $e) {
            // handle error
        }
    }

    public function api() {
        $output = $this->output;
        if(!$output) throw new Exception("Something went wrong! Gateway render failed. Please call gateway() method before calling api() method");
        $sources = $this->setSource(PaymentGatewayConst::APP);
        $url_params = $this->makeUrlParams($sources);
        $this->setUrlParams($url_params);
        return $this;
    }

    public function setSource(string $source) {
        $sources = [
            'r-source'  => $source,
        ];

        return $sources;
    }

    public function makeUrlParams(array $sources) {
        try{
            $params = http_build_query($sources);
        }catch(Exception $e) {
            throw new Exception("Something went wrong! Failed to make URL Params.");
        }
        return $params;
    }

    public function setUrlParams(string $url_params) {
        $output = $this->output;
        if(!$output) throw new Exception("Something went wrong! Gateway render failed. Please call gateway() method before calling api() method");
        if(isset($output['url_params'])) {
            // if already param has
            $params = $this->output['url_params'];
            $update_params = $params . "&" . $url_params;
            $this->output['url_params'] = $update_params; // Update/ reassign URL Parameters
        }else {
            $this->output['url_params']  = $url_params; // add new URL Parameters;
        }
    }

    public function getUrlParams() {
        $output = $this->output;
        
        if(!$output || !isset($output['url_params'])) $params = "";
        $params = $output['url_params'] ?? "";
        return $params;
    }

    public function setGatewayRoute($route_name, $gateway, $params = null) {
        
        if(!Route::has($route_name)) throw new Exception('Route name ('.$route_name.') is not defined');
        if($params) {
            return route($route_name,$gateway."?".$params);
        }
        
        return route($route_name,$gateway);
    }

    public function requestIsApiUser() {
        $request_source = request()->get('r-source');
        if($request_source != null && $request_source == PaymentGatewayConst::APP) return true;
        if(request()->routeIs('api.*')) return true;
        return false;
    }

    public static function makePlainText($string) {
        $string = Str::lower($string);
        return preg_replace("/[^A-Za-z0-9]/","",$string);
    }

    public function searchWithReferenceInTransaction($reference) {

        $transaction = DB::table('transactions')->where('callback_ref',$reference)->first();

        if($transaction) {
            return $transaction;
        }

        return false;
    }

    public function handleCallback($reference,$callback_data,$gateway_name) {
        
        if($reference == PaymentGatewayConst::CALLBACK_HANDLE_INTERNAL) {
            $gateway = PaymentGatewayModel::gateway($gateway_name)->first();
            $callback_response_receive_method = $this->getCallbackResponseMethod($gateway);
            return $this->$callback_response_receive_method($callback_data, $gateway);
        }

        $transaction = Transaction::where('callback_ref',$reference)->first();

        $this->output['callback_ref']       = $reference;
        $this->output['capture']            = $callback_data;

        if($transaction) {
            $gateway_currency = $transaction->currency;
            $gateway = $gateway_currency->gateway;

            $requested_amount = $transaction->request_amount;
            $validator_data = [
                $this->currency_input_name  => $transaction->details->user_record,
            ];

            $user_wallet = $transaction->user_wallets;
            $this->predefined_user_wallet = $user_wallet;
            $this->predefined_guard = $transaction->user->modelGuardName();
            $this->predefined_user = $transaction->user;

            $this->output['transaction']    = $transaction;

        }else {
            // find reference on temp table
            $tempData = TemporaryData::where('identifier',$reference)->first();
            if($tempData) {
                $gateway_currency_id = $tempData->data->currency ?? null;
                $gateway_currency = PaymentGatewayCurrency::find($gateway_currency_id);
                if($gateway_currency) {
                    $gateway = $gateway_currency->gateway;

                    $requested_amount = $tempData['data']->amount->requested_amount ?? 0;
                    $validator_data = [
                        $this->currency_input_name  => $tempData->data->user_record,
                        
                    ];

                    $get_wallet_model = PaymentGatewayConst::registerWallet()[$tempData->data->creator_guard];
                   
                    $user_wallet = $get_wallet_model::find($tempData->data->wallet->wallet_id);
                    $this->predefined_user_wallet = $user_wallet;
                    
                    $this->predefined_guard = $user_wallet->user->modelGuardName(); // need to update
                    
                    
                    $this->predefined_user = $user_wallet->user;

                    $this->output['tempData'] = $tempData;
                }
            }
        }


        if(isset($gateway)) {
            
            $this->request_data = $validator_data;
            $this->gateway();

            $callback_response_receive_method = $this->getCallbackResponseMethod($gateway);
            
            return $this->$callback_response_receive_method($reference, $callback_data, $this->output);
        }

        logger("Gateway not found!!" , [
            "reference"     => $reference,
        ]);
    }

    public static function getValueFromGatewayCredentials($gateway, $keywords) {
        $result = "";
        $outer_break = false;
        foreach($keywords as $item) {
            if($outer_break == true) {
                break;
            }
            $modify_item = PaymentGateway::makePlainText($item);
            foreach($gateway->credentials ?? [] as $gatewayInput) {
                $label = $gatewayInput->label ?? "";
                $label = PaymentGateway::makePlainText($label);

                if($label == $modify_item) {
                    $result = $gatewayInput->value ?? "";
                    $outer_break = true;
                    break;
                }
            }
        }
        return $result;
    }

    public function generateLinkForRedirectForm($token, $gateway)
    {
        $redirection = $this->getRedirection();
        $form_redirect_route = $redirection['redirect_form'];
        return route($form_redirect_route, [$gateway, 'token' => $token]);
    }
}
