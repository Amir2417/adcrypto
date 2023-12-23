<?php

namespace App\Models;

use App\Models\Admin\PaymentGateway;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\PaymentGatewayCurrency;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [];

    protected $casts = [
        'id'                          => 'integer',
        'type'                        => "string",
        'user_id'                     => 'integer',
        'user_wallet_id'              => 'integer',
        'payment_gateway_id'          => 'integer',
        'trx_id'                      => 'string',
        'amount'                      => 'decimal:16',
        'percent_charge'              => 'decimal:16',
        'fixed_charge'                => 'decimal:16',
        'total_charge'                => 'decimal:16',
        'total_payable'               => 'decimal:16',
        'available_balance'           => 'decimal:16',
        'currency_code'               => 'string',
        'remark'                      => 'string',
        'details'                     => 'object',
        'reject_reason'               => 'string',
        'callback_ref'                => 'string',
        'status'                      => 'integer',
        'created_at'                  => 'date:Y-m-d',
        'updated_at'                  => 'date:Y-m-d',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_wallets()
    {
        return $this->belongsTo(UserWallet::class, 'user_wallet_id');
    }
    public function payment_gateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
    public function currency()
    {
        return $this->belongsTo(PaymentGatewayCurrency::class,'payment_gateway_id');
    }
}
