<?php

namespace Database\Seeders\Admin;

use App\Constants\PaymentGatewayConst;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\PaymentGatewayCurrency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $payment_gateways = array(
            array('slug' => 'payment-method','code' => '105','type' => 'AUTOMATIC','name' => 'Paypal','title' => 'Paypal Gateway','alias' => 'paypal','image' => 'seeder/paypal.webp','credentials' => '[{"label":"Client ID","placeholder":"Enter Client ID","name":"client-id","value":"AbMgZu03hDEAs8aMK96dj52nCFfEEFd2nSffXsdf8NIBbOiogClRVFbsFqxqPjQHeb221XXCrZR2GXyZ"},{"label":"Secret ID","placeholder":"Enter Secret ID","name":"secret-id","value":"EHjAeQn76vtKvJBUipJ54BFqUrcuP4bB01xgbAGAn7q-p5WgtGzj6FFeEzXuTNEVaPtCcP4qKSwQu0sb"}]','supported_currencies' => '["USD","GBP","PHP","NZD","MYR","EUR","CNY","CAD","AUD"]','crypto' => '0','desc' => NULL,'input_fields' => NULL,'env' => 'SANDBOX','status' => '1','last_edit_by' => '1','created_at' => '2023-05-29 11:09:41','updated_at' => '2023-11-30 08:42:48'),

            array('slug' => 'payment-method','code' => '125','type' => 'AUTOMATIC','name' => 'Stripe','title' => 'Stripe Gateway','alias' => 'stripe','image' => 'seeder/stripe.webp','credentials' => '[{"label":"Test Publishable Key","placeholder":"Enter Test Publishable Key","name":"test-publishable-key","value":"pk_test_51NECrlJXLo7QTdMco2E4YxHSeoBnDvKmmi0CZl3hxjGgH1JwgcLVUF3ZR0yFraoRgT7hf0LtOReFADhShAZqTNuB003PnBSlGP"},{"label":"Test Secret Key","placeholder":"Enter Test Secret Key","name":"test-secret-key","value":"sk_test_51NECrlJXLo7QTdMc2x7K5LaDuiS0MGNYHkO9dzzV0Y9XuWNZsXjECFsusjZEnqtxMIjCh3qtogc5sHHwL2oQ083900aFy1k7DE"},{"label":"Live Publishable Key","placeholder":"Enter Live Publishable Key","name":"live-publishable-key","value":null},{"label":"Live Secret Key","placeholder":"Enter Live Secret Key","name":"live-secret-key","value":null}]','supported_currencies' => '["USD","GBP","PHP","NZD","MYR","EUR","CNY","CAD","AUD","NGN"]','crypto' => '0','desc' => NULL,'input_fields' => NULL,'env' => 'SANDBOX','status' => '1','last_edit_by' => '1','created_at' => '2023-11-30 08:42:28','updated_at' => '2023-11-30 08:43:57'),

            array('slug' => 'payment-method','code' => '130','type' => 'AUTOMATIC','name' => 'Flutterwave','title' => 'Flutterwave Gateway','alias' => 'flutterwave','image' => 'seeder/flutterwave.webp','credentials' => '[{"label":"Encryption key","placeholder":"Enter Encryption key","name":"encryption-key","value":"FLWSECK_TEST27bee2235efd"},{"label":"Secret key","placeholder":"Enter Secret key","name":"secret-key","value":"FLWSECK_TEST-da35e3dbd28be1e7dc5d5f3519e2ebef-X"}]','supported_currencies' => '["USD","GBP","PHP","NZD","MYR","EUR","CNY","CAD","AUD","NGN"]','crypto' => '0','desc' => NULL,'input_fields' => NULL,'env' => 'SANDBOX','status' => '1','last_edit_by' => '1','created_at' => '2023-11-30 08:49:31','updated_at' => '2023-11-30 08:51:26'),

            array('slug' => 'payment-method','code' => '120','type' => 'AUTOMATIC','name' => 'CoinGate','title' => 'Crypto Payment gateway','alias' => 'coingate','image' => 'seeder/coin_gate.png','credentials' => '[{"label":"Sandbox URL","placeholder":"Enter Sandbox URL","name":"sandbox-url","value":"https:\\/\\/api-sandbox.coingate.com\\/v2"},{"label":"Sandbox App Token","placeholder":"Enter Sandbox App Token","name":"sandbox-app-token","value":"XJW4RyhT8F-xssX2PvaHMWJjYe5nsbsrbb2Uqy4m"},{"label":"Production URL","placeholder":"Enter Production URL","name":"production-url","value":"https:\\/\\/api.coingate.com\\/v2"},{"label":"Production App Token","placeholder":"Enter Production App Token","name":"production-app-token","value":null}]','supported_currencies' => '["USD","BTC","LTC","ETH","BCH","TRX","ETC","DOGE","BTG","BNB","TUSD","USDT","BSV","MATIC","BUSD","SOL","WBTC","RVN","BCD","ATOM","BTTC","EURT"]','crypto' => '1','desc' => NULL,'input_fields' => NULL,'env' => 'SANDBOX','status' => '1','last_edit_by' => '1','created_at' => '2023-08-07 10:36:30','updated_at' => '2023-08-07 12:06:12'),

            array('slug' => 'payment-method','code' => '215','type' => 'AUTOMATIC','name' => 'Tatum','title' => 'Tatum Gateway','alias' => 'tatum','image' => 'seeder/tatum.jpg','credentials' => '[{"label":"Testnet","placeholder":"Enter Testnet","name":"test-net","value":"t-64c8e10396979a001d135363-64c8e10496979a001d135367"},{"label":"Mainnet","placeholder":"Enter Mainnet","name":"main-net","value":"t-64c8e10396979a001d135363-64c8e10496979a001d135369"}]','supported_currencies' => '["BTC","ETH","SOL"]','crypto' => '1','desc' => NULL,'input_fields' => NULL,'env' => 'SANDBOX','status' => '1','last_edit_by' => '1','created_at' => '2023-11-07 17:05:37','updated_at' => '2023-11-07 17:44:00'),

            array('slug' => 'payment-method','code' => '135','type' => 'AUTOMATIC','name' => 'SSLCommerz','title' => 'SSLCommerz Payment Gateway For Add Money','alias' => 'sslcommerz','image' => 'seeder/sslcommerz.webp','credentials' => '[{"label":"Store Id","placeholder":"Enter Store Id","name":"store-id","value":"appde6513b3970d62c"},{"label":"Store Password","placeholder":"Enter Store Password","name":"store-password","value":"appde6513b3970d62c@ssl"},{"label":"Sandbox Url","placeholder":"Enter Sandbox Url","name":"sandbox-url","value":"https:\\/\\/sandbox.sslcommerz.com"},{"label":"Live Url","placeholder":"Enter Live Url","name":"live-url","value":"https:\\/\\/securepay.sslcommerz.com"}]','supported_currencies' => '["BDT","EUR","GBP","AUD","USD","CAD"]','crypto' => '0','desc' => NULL,'input_fields' => NULL,'env' => 'SANDBOX','status' => '1','last_edit_by' => '1','created_at' => '2023-11-30 08:56:22','updated_at' => '2023-11-30 08:58:11'),

            array('slug' => 'payment-method','code' => '140','type' => 'AUTOMATIC','name' => 'RazorPay','title' => 'Razor Pay Payment Gateway','alias' => 'razorpay','image' => 'seeder/razor-pay.webp','credentials' => '[{"label":"Public key","placeholder":"Enter Public key","name":"public-key","value":"rzp_test_B6FCT9ZBZylfoY"},{"label":"Secret Key","placeholder":"Enter Secret Key","name":"secret-key","value":"s4UYHtNwq5TkHSexU5Pnp1pm"}]','supported_currencies' => '["INR"]','crypto' => '0','desc' => NULL,'input_fields' => NULL,'env' => NULL,'status' => '1','last_edit_by' => '1','created_at' => '2023-11-30 09:00:10','updated_at' => '2023-11-30 09:00:10'),
        
            array('slug' => 'payment-method','code' => '160','type' => 'MANUAL','name' => 'JazzCash','title' => 'JazzCash Gateway','alias' => 'jazzcash','image' => NULL,'credentials' => NULL,'supported_currencies' => '["PKR"]','crypto' => '0','desc' => '<p>To initiate a payment using our manual payment gateway, please follow the instructions provided below. We offer two convenient methods for you to choose from:<br><strong>Option 1: PayPal Payment</strong></p><ol style="list-style-type:none;"><li>Log in to your PayPal account or access the PayPal website.</li><li>Choose the option to send money or make a payment.</li><li>Enter the recipient’s email address: <a href="mailto:business@paypal.com">business@paypal.com</a></li><li>Specify the payment amount in the currency you wish to use.</li><li>Make sure to select “Business” as the account type.</li><li>Review the payment details and confirm the transaction.</li><li>Keep the payment confirmation or receipt as proof of the transaction.</li></ol><p><strong>Option 2: Bank Transfer</strong></p><ol style="list-style-type:none;"><li>Visit your local bank or access your online banking platform.</li><li>Initiate a new fund transfer or payment.</li><li>Enter the recipient’s bank account details:</li></ol><ul style="list-style-type:none;"><li>Bank Name: Bank of America</li><li>IBAN (International Bank Account Number): 01234567890</li></ul><ol style="list-style-type:none;"><li>Specify the payment amount in the currency you intend to use.</li><li>Double-check all details, including the recipient’s account information.</li><li>Confirm and authorize the transfer.</li><li>Retain the payment receipt or confirmation for future reference.</li></ol><p>Please ensure that you keep a record of your payment as proof of the transaction. In case of any discrepancies or verification requirements, you may be asked to provide this documentation.Your payment will be manually verified by our team, and once confirmed, your order will be processed promptly. We appreciate your cooperation and look forward to serving you!</p>','input_fields' => '[{"type":"file","label":"Screenshot","name":"screenshot","required":false,"validation":{"max":"10","mimes":["jpg","png","webp","svg"],"min":"0","options":[],"required":false}},{"type":"text","label":"Transaction ID","name":"transaction_id","required":true,"validation":{"max":"60","mimes":[],"min":"1","options":[],"required":true}}]','env' => NULL,'status' => '1','last_edit_by' => '1','created_at' => NULL,'updated_at' => NULL),
        
        );

        PaymentGateway::insert($payment_gateways);

        $payment_gateway_currencies = array(
            array('payment_gateway_id' => '1','name' => 'Paypal USD','alias' => 'payment-method-paypal-usd-automatic','currency_code' => 'USD','currency_symbol' => '$','image' => 'seeder/paypal.webp','min_limit' => '40000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '37675.20000000','created_at' => '2023-11-30 07:22:48','updated_at' => '2023-11-30 08:42:48'),

            array('payment_gateway_id' => '2','name' => 'Stripe AUD','alias' => 'payment-method-stripe-aud-automatic','currency_code' => 'AUD','currency_symbol' => 'A$','image' => 'seeder/stripe.webp','min_limit' => '40000.00000000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '56845.10000000','created_at' => '2023-11-30 08:43:57','updated_at' => '2023-11-30 08:43:57'),

            array('payment_gateway_id' => '3','name' => 'Flutterwave NGN','alias' => 'payment-method-flutterwave-ngn-automatic','currency_code' => 'NGN','currency_symbol' => '₦','image' => 'seeder/flutterwave.webp','min_limit' => '40000.00000000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '29778649.15000000','created_at' => '2023-11-30 08:51:26','updated_at' => '2023-11-30 08:51:26'),

            array('payment_gateway_id' => '4','name' => 'CoinGate BNB','alias' => 'payment-method-coingate-bnb-automatic','currency_code' => 'BNB','currency_symbol' => 'BNB','image' => NULL,'min_limit' => '1.00000000','max_limit' => '1000.00000000','percent_charge' => '3.00000000','fixed_charge' => '0.00000000','rate' => '0.00410000','created_at' => '2023-08-07 12:06:12','updated_at' => '2023-08-07 12:36:10'),

            array('payment_gateway_id' => '5','name' => 'Tatum BTC','alias' => 'payment-method-tatum-btc-automatic','currency_code' => 'BTC','currency_symbol' => 'BTC','image' => NULL,'min_limit' => '1.00000000','max_limit' => '20000.00000000','percent_charge' => '2.00000000','fixed_charge' => '1.00000000','rate' => '0.00002900','created_at' => '2023-11-07 17:10:38','updated_at' => '2023-11-07 17:44:00'),

            array('payment_gateway_id' => '8','name' => 'JazzCash PKR','alias' => 'payment-method-jazzcash-pkr-manual','currency_code' => 'PKR','currency_symbol' => 'Rs','image' => NULL,'min_limit' => '1.00000000','max_limit' => '10000.00000000','percent_charge' => '3.00000000','fixed_charge' => '1.00000000','rate' => '289.38000000','created_at' => '2023-08-14 18:13:11','updated_at' => '2023-08-14 18:13:11'),
        );

        PaymentGatewayCurrency::insert($payment_gateway_currencies);


    }
}
