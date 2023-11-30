<?php
namespace App\Constants;
use Illuminate\Support\Str;

class PaymentGatewayConst {

    const AUTOMATIC = "AUTOMATIC";
    const MANUAL    = "MANUAL";
    const ADDMONEY  = "Add Money";
    const PAYMENTMETHOD  = "Payment Method";
    const MONEYOUT  = "Money Out";
    const ACTIVE    =  true;

    const ENV_SANDBOX       = "SANDBOX";
    const ENV_PRODUCTION    = "PRODUCTION";

    
    public static function payment_method_slug() {
        return Str::slug(self::PAYMENTMETHOD);
    }


    public static function money_out_slug() {
        return Str::slug(self::MONEYOUT);
    }
}
