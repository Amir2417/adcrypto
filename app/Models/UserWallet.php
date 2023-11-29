<?php

namespace App\Models;

use App\Models\Admin\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserWallet extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['balance', 'status','user_id','currency_id','created_at','updated_at'];

    public function scopeAuth($query) {
        return $query->where('user_id',auth()->user()->id);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
