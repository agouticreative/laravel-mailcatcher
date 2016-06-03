<?php

namespace Agouti\LaravelMailcatcher;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config.php' => config_path('mailcatcher.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('mailcatcher', function () {
            return new Client();
        });
    }
}
