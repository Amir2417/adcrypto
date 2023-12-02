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
    const CRYPTO                    = "CRYPTO";
    const CRYPTO_NATIVE             = "CRYPTO_NATIVE";

    const NOT_USED  = "NOT-USED";
    const USED      = "USED";
    const SENT      = "SENT";

    const STATUSSUCCESS             = 1;
    const STATUSPENDING             = 2;
    const STATUSHOLD                = 3;
    const STATUSREJECTED            = 4;
    const STATUSWAITING             = 5;

    const ASSET_TYPE_WALLET         = "WALLET";

    const PAYPAL                    = 'paypal';
    const G_PAY                     = 'gpay';
    const COIN_GATE                 = 'coingate';
    const QRPAY                     = 'qrpay';
    const TATUM                     = 'tatum';
    const STRIPE                    = 'stripe';
    const FLUTTERWAVE               = 'flutterwave';
    const SSLCOMMERZ                = 'sslcommerz';
    const RAZORPAY                  = 'razorpay';
    
    public static function payment_method_slug() {
        return Str::slug(self::PAYMENTMETHOD);
    }


    public static function money_out_slug() {
        return Str::slug(self::MONEYOUT);
    }

    public static function register($alias = null) {
        $gateway_alias  = [
            self::PAYPAL        => "paypalInit",
            self::G_PAY         => "gpayInit",
            self::COIN_GATE     => "coinGateInit",
            self::QRPAY         => "qrpayInit",
            self::TATUM         => 'tatumInit',
            self::STRIPE        => 'stripeInit',
            self::FLUTTERWAVE   => 'flutterwaveInit',
            self::SSLCOMMERZ    => 'sslCommerzInit',
            self::RAZORPAY      => 'razorpayInit',
        ];

        if($alias == null) {
            return $gateway_alias;
        }

        if(array_key_exists($alias,$gateway_alias)) {
            return $gateway_alias[$alias];
        }
        return "init";
    }

    public static function registerGatewayRecognization() {
        return [
            'isGpay'        => self::G_PAY,
            'isPaypal'      => self::PAYPAL,
            'isCoinGate'    => self::COIN_GATE,
            'isQrpay'       => self::QRPAY,
            'isTatum'       => self::TATUM,
            'isStripe'      => self::STRIPE,
            'isFlutterwave' => self::FLUTTERWAVE,
            'isSslCommerz'  => self::SSLCOMMERZ,
            'isRazorpay'    => self::RAZORPAY,
        ];
    }
}
