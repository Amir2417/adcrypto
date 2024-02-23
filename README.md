<<<<<<<< Update Guide >>>>>>>>>>>
Immediate Older Version : 1.0.0
Current Version : 1.1.0

Update Feature
1. Perfect Money payment gateway added.

Please User Those Command On Your Terminal To Update Full System
.
1. To Run Project Please Run This Command On Your Terminal
    composer update && composer dumpautoload  && php artisan migrate && php artisan passport:install --force

2. To Update Fresh Basic Settings Seeder Please Run This Command On Your Terminal
    php artisan db:seed --class=Database\\Seeders\\Admin\\FreshBasicSettingsSeeder

3. To Update Payment Gateway Seeder Please Run This Command On Your Terminal
    php artisan db:seed --class=Database\\Seeders\\Admin\\PaymentGatewaySeeder