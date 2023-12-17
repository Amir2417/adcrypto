<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\UserWallet;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryData;
use App\Models\Admin\Currency;
use App\Models\UserNotification;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;
use App\Models\Admin\TransactionSetting;
use Illuminate\Support\Facades\Validator;

class ExchangeCryptoController extends Controller
{
    /**
     * Method for view exchange crypto page
     * @return view
     */
    public function index(){
        $page_title         = "- Exchange Crypto";
        $currencies         = UserWallet::auth()->with(['currency'])->get();
        $transaction_fees   = TransactionSetting::where('slug','exchange')->first();
        
        return view('user.sections.exchange-crypto.index',compact(
            'page_title',
            'currencies',
            'transaction_fees'
        ));
    }
    /**
     * Method for store exchange crypto
     */
    public function store(Request $request){
        $validator   = Validator::make($request->all(),[
            'send_amount'       => 'required',
            'sender_wallet'     => 'required',
            'receive_money'     => 'required',
            'receiver_currency' => 'required',
        ]);
        if($validator->fails()){
            return back()->withErrors($$validator)->withInput($request->all());
        }
        $validated                  = $validator->validate();
        $send_amount                = $validated['send_amount'];
        $sender_wallet              = $validated['sender_wallet'];
        $receiver_wallet            = $validated['receiver_currency'];
        $validated['identifier']    = Str::uuid();

        $send_wallet        = UserWallet::auth()->whereHas("currency",function($q) use ($sender_wallet) {
            $q->where("id",$sender_wallet)->active();
        })->active()->first();
        
        if(!$send_wallet){
            return back()->with(['error' => ['Sender Wallet not found!']]);
        }
        
        if($send_amount > $send_wallet->balance){
            return back()->with(['error' => ['Insufficient Balance!']]);
        }
        $receive_wallet     = UserWallet::auth()->whereHas("currency",function($q) use ($receiver_wallet) {
            $q->where("id",$receiver_wallet)->active();
        })->active()->first();

        if(!$receive_wallet){
            return back()->with(['error' => ['Receiver Wallet not found!']]);
        }

        $sender_rate        = $send_wallet->currency->rate;
        $receiver_rate      = $receive_wallet->currency->rate;
        $exchange_rate      = $receiver_rate / $sender_rate;
        $amount             = $send_amount * $exchange_rate;
        $transaction_fees   = TransactionSetting::where('slug','exchange')->first();
        $min_limit          = $transaction_fees->min_limit;
        $max_limit          = $transaction_fees->max_limit;
        $min_limit_calc     = $min_limit * $exchange_rate;
        $max_limit_calc     = $max_limit * $exchange_rate;

        if($amount < $min_limit_calc || $amount > $max_limit_calc){
            return back()->with(['error' => ['Please follow the transaction limit.']]);
        }
        $charge_rate    = $send_wallet->currency->rate / $send_wallet->currency->rate;
        $fixed_charge   = $transaction_fees->fixed_charge * $charge_rate;
        $percent_charge = ($send_amount / 100) * $transaction_fees->percent_charge;
        
        $total_charge   = $fixed_charge + $percent_charge;

        if($send_amount + $total_charge > $send_wallet->balance){
            return back()->with(['error' => ['Insufficient Balance!']]);
        }
        $payable        = $send_amount + $total_charge;
    
        $data               = [
            'type'          => PaymentGatewayConst::EXCHANGE_CRYPTO,
            'identifier'    => $validated['identifier'],
            'data'          => [
                'sender_wallet'     => [
                    'id'            => $send_wallet->id,
                    'name'          => $send_wallet->currency->name,
                    'code'          => $send_wallet->currency->code,
                    'rate'          => $send_wallet->currency->rate,
                    'balance'       => $send_wallet->balance,
                ],
                'receiver_wallet'   => [
                    'id'            => $receive_wallet->id,
                    'name'          => $receive_wallet->currency->name,
                    'code'          => $receive_wallet->currency->code,
                    'rate'          => $receive_wallet->currency->rate,
                    'balance'       => $receive_wallet->balance,
                ],
                'exchange_rate'     => $exchange_rate,
                'sending_amount'    => $send_amount,
                'fixed_charge'      => $fixed_charge,
                'percent_charge'    => $percent_charge,
                'total_charge'      => $total_charge,
                'payable_amount'    => $payable,
                'get_amount'        => $amount,
            ],        
        ];
        
        try{
            $temporary_data = TemporaryData::create($data);
        }catch(Exception $e){
           return back()->with(['error' => ['Something went wrong! Please try again.']]); 
        }
        return redirect()->route('user.exchange.crypto.preview',$temporary_data->identifier);
    }
    /**
     * Method for show exchange data in the preview page
     * @param $identifier
     * @return view
     */
    public function preview($identifier){
        $page_title     = "- Exchange Preview";
        $data           = TemporaryData::where('identifier',$identifier)->first();
        if(!$data) return back()->with(['error' => ['Data not Found!']]);

        return view('user.sections.exchange-crypto.preview',compact(
            'page_title',
            'data'
        ));
    }
    /**
     * Method for confirm exchange crypto
     * @param $identifier
     * @param \Illuminate\Http\Request $request
     */
    public function confirm($identifier){
        $record          = TemporaryData::where('identifier',$identifier)->first();
        if(!$record) return back()->with(['error'  => ['Data not found!']]);
        $trx_id = generateTrxString("transactions","trx_id","EC",8);
        
        $send_wallet  = $record->data->sender_wallet->id;
        
        $sender_wallet  = UserWallet::auth()->whereHas("currency",function($q) use ($send_wallet) {
            $q->where("id",$send_wallet)->active();
        })->active()->first();
    
        $available_balance  = $sender_wallet->balance - $record->data->payable_amount;
        

        $data            = [
            'type'              => $record->type,
            'user_id'           => auth()->user()->id,
            'user_wallet_id'    => $record->data->sender_wallet->id,
            'trx_id'            => $trx_id,
            'amount'            => $record->data->sending_amount,
            'percent_charge'    => $record->data->percent_charge,
            'fixed_charge'      => $record->data->fixed_charge,
            'total_charge'      => $record->data->total_charge,
            'total_payable'     => $record->data->payable_amount,
            'available_balance' => $available_balance,
            'currency_code'     => $record->data->sender_wallet->code,
            'remark'            => ucwords(remove_special_char($record->type," ")) . " With " . $record->data->sender_wallet->name,
            'details'           => [
                'data' => $record->data
            ],
            'status'            => global_const()::STATUS_CONFIRM_PAYMENT,
            'created_at'        => now(),
        ];

        try{
            Transaction::create($data);
            
            $this->updateSenderWalletBalance($sender_wallet,$available_balance);
            $this->updateReceiverWalletBalance($record->identifier);
            $this->userNotification($record);
            $record->delete();

        }catch(Exception $e){
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }
        return redirect()->route('user.exchange.crypto.index')->with(['success' => ['Successfully! Exchange Crypto request sent to Admin.']]);       
    }

    //update sender wallet balance
    function updateSenderWalletBalance($sender_wallet,$available_balance){
        $sender_wallet->update([
            'balance'   => $available_balance,
        ]);
    }

    // update receiver wallet balance
    function updateReceiverWalletBalance($identifier){
        $record          = TemporaryData::where('identifier',$identifier)->first();
        if(!$record) return back()->with(['error'  => ['Data not found!']]);
        $wallet  = $record->data->receiver_wallet->id;

        $receiver_wallet  = UserWallet::auth()->whereHas("currency",function($q) use ($wallet) {
            $q->where("id",$wallet)->active();
        })->active()->first();

        $balance  = $receiver_wallet->balance + $record->data->get_amount;

        $receiver_wallet->update([
            'balance'   => $balance,
        ]);
    }

    function userNotification($record){
        UserNotification::create([
            'user_id'       => auth()->user()->id,
            'message'       => [
                'title'     => "Exchange Crypto",
                'wallet'    => $record->data->sender_wallet->name,
                'code'      => $record->data->sender_wallet->code,
                'amount'    => $record->data->sending_amount,
                'success'   => "Successfully Request Send."
            ],
        ]);
    }

}
