<?php

namespace Sykez\FireMobileSms;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->when(SmsChannel::class)
            ->needs(Sms::class)
            ->give(static function () {
                return new Sms(
					config('services.fmsms.url'),
					config('services.fmsms.username'),
					config('services.fmsms.password'),
					config('services.fmsms.from'),
					new Client()
                );
            });
    }
}
