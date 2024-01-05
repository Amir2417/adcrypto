<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Method for view buy log page
     * @return view
     */
    public function buyLog(){
        $page_title  = "- Buy Logs";
        $transactions = Transaction::where("type",PaymentGatewayConst::BUY_CRYPTO)->orderBy('id','desc')->get();
        
        return view('user.sections.transaction-logs.buy-log',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for view sell log page
     * @return view
     */
    public function sellLog(){
        $page_title     = "- Sell Logs";
        $transactions   = Transaction::where("type",PaymentGatewayConst::SELL_CRYPTO)->orderBy('id','desc')->get();
        

        return view('user.sections.transaction-logs.sell-log',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for view withdraw log page
     * @return view
     */
    public function withdrawLog(){
        $page_title     = "- Withdraw Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)->orderBy('id','desc')->get();

        return view('user.sections.transaction-logs.withdraw-log',compact(
            'page_title',
            'transactions'
        ));
    }
    /**
     * Method for view exchange log page
     * @return view
     */
    public function exchangeLog(){
        $page_title     = "- Exchange Logs";
        $transactions   = Transaction::where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)->orderBy('id','desc')->get();

        return view('user.sections.transaction-logs.exchange-log',compact(
            'page_title',
            'transactions',
        ));
    }
    /** 
    * Method for search buy crypto log  
    */
    public function buyLogSearch(Request $request){
        $validator = Validator::make($request->all(),[
            'search_text'  => 'nullable|string',
        ]);

        if($validator->fails()) {
            return Response::error($validator->errors(),null,400);
        }

        $validated = $validator->validate();
        try{
            if($validated['search_text'] != "" || $validated['search_text'] != null){
                $transaction    = Transaction::auth()->where('type',PaymentGatewayConst::BUY_CRYPTO)
                                    ->search($validated['search_text'])->get();
            }else{
                $transaction    = Transaction::auth()->where('type',PaymentGatewayConst::BUY_CRYPTO)->get();
            }
            
        }catch(Exception $e){
            return Response::error(['Something went worng!. Please try again.'],null,500);
        }
        
        return response()->json(['transactions' => $transaction]);

    }
    /** 
    * Method for search withdraw crypto log  
    */
    public function withdrawLogSearch(Request $request){
       
        $validator = Validator::make($request->all(),[
            'search_text'  => 'nullable|string',
        ]);

        if($validator->fails()) {
            return Response::error($validator->errors(),null,400);
        }

        $validated = $validator->validate();
        try{
            if($validated['search_text'] != "" || $validated['search_text'] != null){
                $transaction    = Transaction::auth()->where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)
                                    ->search($validated['search_text'])->get();
            }else{
                $transaction    = Transaction::auth()->where('type',PaymentGatewayConst::WITHDRAW_CRYPTO)->get();
            }
            
        }catch(Exception $e){
            return Response::error(['Something went worng!. Please try again.'],null,500);
        }
        
        return response()->json(['transactions' => $transaction]);

    }
    /** 
    * Method for search exchange crypto log  
    */
    public function exchangeLogSearch(Request $request){
       
        $validator = Validator::make($request->all(),[
            'search_text'  => 'nullable|string',
        ]);

        if($validator->fails()) {
            return Response::error($validator->errors(),null,400);
        }

        $validated = $validator->validate();
        try{
            if($validated['search_text'] != "" || $validated['search_text'] != null){
                $transaction    = Transaction::auth()->where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)
                                    ->search($validated['search_text'])->get();
            }else{
                $transaction    = Transaction::auth()->where('type',PaymentGatewayConst::EXCHANGE_CRYPTO)->get();
            }
            
        }catch(Exception $e){
            return Response::error(['Something went worng!. Please try again.'],null,500);
        }
        
        return response()->json(['transactions' => $transaction]);

    }
}
