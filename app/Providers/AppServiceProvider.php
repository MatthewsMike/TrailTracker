<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        //https://laracasts.com/discuss/channels/laravel/laravel-54-failing-on-php-artisan-migrate-after-php-artisan-makeauth
        //Prevent Migration Scripts from Failing with error:
        //  Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes (SQL: alter table `users` add unique `users_email_unique`(`email`))
        Schema::defaultStringLength(191);
    }
}
