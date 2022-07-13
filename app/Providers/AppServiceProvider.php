<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        //ServerProvider::class => DigitalOceanServerProvider::class,
    ];

    public $singletons = [
        
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    
    }
}
