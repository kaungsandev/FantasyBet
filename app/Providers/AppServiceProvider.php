<?php

namespace App\Providers;

use App\Services\ConvertKitNewsLetter;
use App\Services\MailchimpNewsLetter;
use App\Services\NewsLetter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(NewsLetter::class,function(){
            $client  = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => config('services.mailchimp.server')
            ]);
            return new MailchimpNewsLetter($client); 
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
