<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Constants\PaymentGatewayConst;

class TransactionLogController extends Controller
{
    /**
     * Method for get the transaction log 
     */
    public function all(){
        $all_transactions     = Transaction::get()->map(function($data){
           
            
            return [
                'id'                        => $data->id,
                'type'                      => $data->type,
                'user_id'                   => $data->user_id,
                'user_wallet_id'            => $data->user_wallet_id ?? '',
                'payment_gateway_id'        => $data->payment_gateway_id ?? '',
                'trx_id'                    => $data->trx_id,
                'amount'                    => $data->amount,
                'percent_charge'            => $data->percent_charge,
                'fixed_charge'              => $data->fixed_charge,
                'total_charge'              => $data->total_charge,
                'total_payable'             => $data->total_payable,
                'available_balance'         => $data->available_balance,
                'remark'                    => $data->remark,
                'details'                   => $data->details,
                'submit_url'                => $submit_url ?? '',
                // 'requirements'              => $data->details->payment_info->requirements ?? [],
                'reject_reason'             => $data->reject_reason,
                'status'                    => $data->status
            ];
            
        });
        return Response::success([__("Transaction Logs")],[
            'Transactions' => $all_transactions,
        ],200);
        
        
    }
    /**
     * Method for buy crypto log
     */
    public function buyLog(){
        $buy_log     = Transaction::where('type',PaymentGatewayConst::BUY_CRYPTO)->get()->map(function($data){
            if($data->currency->gateway->isTatum($data->currency->gateway) && $data->status == global_const()::STATUS_PENDING){
                $submit_url     = route('api.user.buy.crypto.payment.crypto.confirm',$data->trx_id); 
            }else{
                $submit_url     = '';
            }
            
            return [
                'id'                        => $data->id,
                'type'                      => $data->type,
                'user_id'                   => $data->user_id,
                'user_wallet_id'            => $data->user_wallet_id ?? '',
                'payment_gateway_id'        => $data->payment_gateway_id ?? '',
                'trx_id'                    => $data->trx_id,
                'amount'                    => $data->amount,
                'percent_charge'            => $data->percent_charge,
                'fixed_charge'              => $data->fixed_charge,
                'total_charge'              => $data->total_charge,
                'total_payable'             => $data->total_payable,
                'available_balance'         => $data->available_balance,
                'remark'                    => $data->remark,
                'details'                   => $data->details,
                'submit_url'                => $submit_url,
                'requirements'              => $data->details->payment_info->requirements ?? [],
                'reject_reason'             => $data->reject_reason,
                'status'                    => $data->status
            ];
            
        });
        return Response::success([__("Transaction Logs")],[
            'buy_log' => $buy_log,
        ],200);
    }
}
