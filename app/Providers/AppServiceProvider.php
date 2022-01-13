<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Blackbaud\Provider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'blackbaud',
            function ($app) use ($socialite) {
                $config = $app['config']['services.blackbaud'];
                return $socialite->buildProvider(Provider::class, $config);
            }
        );
    }
}
