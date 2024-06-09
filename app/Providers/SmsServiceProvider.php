<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\SmsHelper;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('sms.helper', function () {
            return new SmsHelper();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
