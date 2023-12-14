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

            array('slug' => 'payment-method','code' => '135','type' => 'AUTOMATIC','name' => 'SSLCommerz','title' => 'SSLCommerz Payment Gateway For Add Money','alias' => 'sslcommerz','image' => 'seeder/sslcommerz.webp','credentials' => '[{"label":"Store Id","placeholder":"Enter Store Id","name":"store-id","value":"appde6513b3970d62c"},{"label":"Store Password","placeholder":"Enter Store Password","name":"store-password","value":"appde6513b3970d62c@ssl"},{"label":"Sandbox Url","placeholder":"Enter Sandbox Url","name":"sandbox-url","value":"https:\\/\\/sandbox.sslcommerz.com"},{"label":"Live Url","placeholder":"Enter Live Url","name":"live-url","value":"https:\\/\\/securepay.sslcommerz.com"}]','supported_currencies' => '["BDT","EUR","GBP","AUD","USD","CAD"]','crypto' => '0','desc' => NULL,'input_fields' => NULL,'env' => 'SANDBOX','status' => '1','last_edit_by' => '1','created_at' => '2023-11-30 08:56:22','updated_at' => '2023-11-30 08:58:11'),

            array('slug' => 'payment-method','code' => '140','type' => 'AUTOMATIC','name' => 'RazorPay','title' => 'Razor Pay Payment Gateway','alias' => 'razorpay','image' => 'seeder/razor-pay.webp','credentials' => '[{"label":"Public key","placeholder":"Enter Public key","name":"public-key","value":"rzp_test_B6FCT9ZBZylfoY"},{"label":"Secret Key","placeholder":"Enter Secret Key","name":"secret-key","value":"s4UYHtNwq5TkHSexU5Pnp1pm"}]','supported_currencies' => '["INR"]','crypto' => '0','desc' => NULL,'input_fields' => NULL,'env' => NULL,'status' => '1','last_edit_by' => '1','created_at' => '2023-11-30 09:00:10','updated_at' => '2023-11-30 09:00:10')
        );

        PaymentGateway::insert($payment_gateways);

        $payment_gateway_currencies = array(
            array('payment_gateway_id' => '1','name' => 'Paypal USD','alias' => 'payment-method-paypal-usd-automatic','currency_code' => 'USD','currency_symbol' => '$','image' => 'seeder/paypal.webp','min_limit' => '40000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '37675.20000000','created_at' => '2023-11-30 07:22:48','updated_at' => '2023-11-30 08:42:48'),
            array('payment_gateway_id' => '1','name' => 'Paypal AUD','alias' => 'payment-method-paypal-aud-automatic','currency_code' => 'AUD','currency_symbol' => 'A$','image' => 'seeder/paypal.webp','min_limit' => '40000.00000000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '56845.10000000','created_at' => '2023-11-30 08:39:12','updated_at' => '2023-11-30 08:42:48'),
            array('payment_gateway_id' => '2','name' => 'Stripe AUD','alias' => 'payment-method-stripe-aud-automatic','currency_code' => 'AUD','currency_symbol' => 'A$','image' => 'seeder/stripe.webp','min_limit' => '40000.00000000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '56845.10000000','created_at' => '2023-11-30 08:43:57','updated_at' => '2023-11-30 08:43:57'),
            array('payment_gateway_id' => '2','name' => 'Stripe USD','alias' => 'payment-method-stripe-usd-automatic','currency_code' => 'USD','currency_symbol' => '$','image' => 'seeder/stripe.webp','min_limit' => '40000.00000000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '37675.20000000','created_at' => '2023-11-30 08:43:57','updated_at' => '2023-11-30 08:43:57'),
            array('payment_gateway_id' => '3','name' => 'Flutterwave NGN','alias' => 'payment-method-flutterwave-ngn-automatic','currency_code' => 'NGN','currency_symbol' => '₦','image' => 'seeder/flutterwave.webp','min_limit' => '40000.00000000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '29778649.15000000','created_at' => '2023-11-30 08:51:26','updated_at' => '2023-11-30 08:51:26'),
            array('payment_gateway_id' => '4','name' => 'SSLCommerz BDT','alias' => 'payment-method-sslcommerz-bdt-automatic','currency_code' => 'BDT','currency_symbol' => '৳','image' => 'seeder/sslcommerz.webp','min_limit' => '40000000.00000000','max_limit' => '40000000.00000000','percent_charge' => '1.00000000','fixed_charge' => '2.00000000','rate' => '4164203.44000000','created_at' => '2023-11-30 08:58:11','updated_at' => '2023-11-30 08:58:11')
        );

        PaymentGatewayCurrency::insert($payment_gateway_currencies);


    }
}
