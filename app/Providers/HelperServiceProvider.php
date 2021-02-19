<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        require_once app_path('Helpers/LocalDateTimeHelper.php');
//        require_once app_path('Helpers/InfoHelper.php');
//        require_once app_path('Helpers/TextFormatHelper.php');
        require_once app_path('Helpers/OrderStatusCodeHelper.php');
//        require_once app_path('Helpers/ChatTypeCodeHelper.php');
//        require_once app_path('Helpers/ChatFileHelper.php');
//        require_once app_path('Helpers/SettingsHelper.php');
        require_once app_path('Helpers/PriceHelper.php');
        require_once app_path('Helpers/OrderCountHelper.php');
//        require_once app_path('Helpers/JobStatusAuditCodeHelper.php');
       require_once app_path('Helpers/CommunicationModeHelper.php');
//        require_once app_path('Helpers/NotificationModeHelper.php');
        require_once app_path('Helpers/PaymentStatusHelper.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
