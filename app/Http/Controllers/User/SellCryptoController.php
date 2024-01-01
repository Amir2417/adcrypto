<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\UserWallet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Network;
use App\Models\TemporaryData;
use App\Constants\GlobalConst;
use App\Http\Helpers\Response;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;
use App\Models\Admin\TransactionSetting;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\PaymentGatewayCurrency;
use Illuminate\Auth\Events\Validated;

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
        $transaction_fees   = TransactionSetting::where('slug','sell')->first();
        
        
        return view('user.sections.sell-crypto.index',compact(
            'page_title',
            'currencies',
            'first_currency',
            'transaction_fees'
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
        
        $validator              = Validator::make($request->all(),[
            'wallet_type'       => 'required',
            'sender_currency'   => 'required',
            'network'           => 'required',
            'amount'            => 'required',
        ]);
        if($validator->fails()) return back()->withErrors($validator)->withInput($request->all());

        $validated      = $validator->validate();
        $amount         = $validated['amount'];
        $wallet_currency = $validated['sender_currency'];

        $user_wallet     = UserWallet::auth()->whereHas("currency",function($q) use($wallet_currency) {
            $q->where("currency_id",$wallet_currency)->active();
        })->active()->first();
        
        if(!$user_wallet) return back()->with(['error' => ['Wallet not found!']]);
        if($amount > $user_wallet->balance){
            return back()->with(['error' => ['Sorry! Insufficient Balance.']]);
        }

        $network            = Network::where('id',$validated['network'])->first();
        
        $transaction_fees   = TransactionSetting::where('slug','sell')->first();
        $sender_rate        = $user_wallet->currency->rate;
        $min_limit          = $transaction_fees->min_limit * $sender_rate;
        $max_limit          = $transaction_fees->max_limit * $sender_rate;

        if($amount < $min_limit || $amount > $max_limit){
            return back()->with(['error' => ['Please follow the transaction limit.']]);
        }

        //charge calculation
        $fixed_charge       = $transaction_fees->fixed_charge * $sender_rate;
        $percent_charge     = ($amount / 100) * $transaction_fees->percent_charge;
        $total_charge       = $fixed_charge + $percent_charge;
        $payable_amount     = $amount + $total_charge;
        
        if($payable_amount > $user_wallet->balance){
            return back()->with(['error' => ['Sorry! Insufficient Balance']]);
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
                    'name'          => $network->name,
                    'arrival_time'  => $network->arrival_time,
                ],
                'amount'            => floatval($amount),
                'fixed_charge'      => $fixed_charge,
                'percent_charge'    => $percent_charge,
                'total_charge'      => $total_charge,
                'total_payable'     => $payable_amount,
                'will_get'          => floatval($amount),
            ]
        ];
        try{
            $temporary_data         = TemporaryData::create($data);
        }catch(Exception $e){
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }
        if($temporary_data->data->sender_wallet->type == global_const()::INSIDE_WALLET){
            return redirect()->route('user.sell.crypto.payment.info',$temporary_data->identifier);
        }
    }
    /**
     * Method for view payment info page
     * @param $identifier
     * @return view
     */
    public function paymentInfo($identifier){
        $page_title = "- Payment Info";
        $data       = TemporaryData::where('identifier',$identifier)->first();
        if(!$data) return back()->with(['error' => ['Data not found!']]);
        
        return view('user.sections.sell-crypto.payment-info',compact(
            'page_title',
            'data'
        ));
    }
    /**
     * Method for payment info store
     * @param $identifier
     * @param \Illuminate\Http\Request $request
     */
    public function paymentInfoStore(Request $request,$identifier){
        $temporary_data       = TemporaryData::where('identifier',$identifier)->first();
        if(!$temporary_data) return back()->with(['error' => ['Data not found!']]);
        if($temporary_data->data->sender_wallet->type  == global_const()::INSIDE_WALLET){

            $validator              = Validator::make($request->all(),[
                'bank_name'         => 'required',
                'account_number'    => 'required',
                'branch'            => 'required'
            ]);
            if($validator->fails()) return back()->withErrors($validator)->withInput($request->all());
            $validated                  = $validator->validate();
            $data                       = [
                'type'                  => $temporary_data->type,
                'identifier'            => $temporary_data->identifier,
                'data'                  => [
                    'sender_wallet'     => [
                        'type'          => $temporary_data->data->sender_wallet->type,
                        'wallet_id'     => $temporary_data->data->sender_wallet->wallet_id,
                        'currency_id'   => $temporary_data->data->sender_wallet->currency_id,
                        'name'          => $temporary_data->data->sender_wallet->name,
                        'code'          => $temporary_data->data->sender_wallet->code,
                        'rate'          => $temporary_data->data->sender_wallet->rate,
                        'balance'       => $temporary_data->data->sender_wallet->balance,
                    ],
                    'network'           => [
                        'name'          => $temporary_data->data->network->name,
                        'arrival_time'  => $temporary_data->data->network->arrival_time,
                    ],
                    'bank_name'         => $validated['bank_name'],
                    'account_number'    => $validated['account_number'],
                    'branch'            => $validated['branch'],
                    'amount'            => $temporary_data->data->amount,
                    'fixed_charge'      => $temporary_data->data->fixed_charge,
                    'percent_charge'    => $temporary_data->data->percent_charge,
                    'total_charge'      => $temporary_data->data->total_charge,
                    'total_payable'     => $temporary_data->data->total_payable,
                    'will_get'          => $temporary_data->data->will_get,
                ]
            ];
            try{
                $temporary_data->update($data);
            }catch(Exception $e){
                return back()->with(['error' => ['Something went wrong! Please try again.']]);
            }
            return redirect()->route('user.sell.crypto.preview',$temporary_data->identifier);
        }
    }
    /**
     * Method for sell crypto preview page
     * @param $identifier
     */
    public function preview($identifier){
        $page_title     = "- Sell Crypto Preview";
        $data           = TemporaryData::where('identifier',$identifier)->first();
        if(!$data) return back()->with(['error' => ['Data not found!']]);

        return view('user.sections.sell-crypto.preview',compact(
            'page_title',
            'data'
        ));
    }
}
