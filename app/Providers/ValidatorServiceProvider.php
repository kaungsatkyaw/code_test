<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
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
    public function boot()
    {
        Validator::extend('tel', function ($attribute, $value, $parameters, $validator) {
            if (preg_match("/^09[0-9]{2,4}[0-9]{2,4}[0-9]{3,4}$/", $value)) {
                return true;
            }

            return false;
        });
    }
}
