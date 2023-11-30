<?php

namespace Database\Seeders;

use Database\Seeders\Admin\AdminHasRoleSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Admin\CurrencySeeder;
use Database\Seeders\Admin\SetupKycSeeder;
use Database\Seeders\Admin\SetupSeoSeeder;
use Database\Seeders\Admin\ExtensionSeeder;
use Database\Seeders\Admin\AppSettingsSeeder;
use Database\Seeders\Admin\SiteSectionsSeeder;
use Database\Seeders\Admin\BasicSettingsSeeder;
use Database\Seeders\Admin\BlogSeeder;
use Database\Seeders\Admin\CoinSeeder;
use Database\Seeders\Admin\LanguageSeeder;
use Database\Seeders\Admin\NetworkSeeder;
use Database\Seeders\Admin\PaymentGatewaySeeder;
use Database\Seeders\Admin\RoleSeeder;
use Database\Seeders\Admin\SetupPageSeeder;
use Database\Seeders\Admin\TransactionSettingSeeder;
use Database\Seeders\Admin\UsefulLinkSeeder;
use Database\Seeders\User\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            TransactionSettingSeeder::class,
            BasicSettingsSeeder::class,
            SetupSeoSeeder::class,
            AppSettingsSeeder::class,
            SiteSectionsSeeder::class,
            SetupKycSeeder::class,
            ExtensionSeeder::class,
            AdminHasRoleSeeder::class,
            UserSeeder::class,
            SetupPageSeeder::class,
            PaymentGatewaySeeder::class,
            LanguageSeeder::class,
            UsefulLinkSeeder::class,
            BlogSeeder::class,
            CoinSeeder::class,
            NetworkSeeder::class,
            CurrencySeeder::class,
        ]);
    }
}
