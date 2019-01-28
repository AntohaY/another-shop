<?php

namespace App\Providers;

use App\Http\Controllers\Services\SUResolver;
use Illuminate\Support\ServiceProvider;
use Hivokas\LaravelPassportSocialGrant\Resolvers\SocialUserResolverInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public $bindings = [
        SocialUserResolverInterface::class => SUResolver::class,
    ];
}
