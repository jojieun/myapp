<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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

            app()->setLocale('ko');
        // 카본 인스턴스의 언어를 설정한다.
        \Carbon\Carbon::setLocale(app()->getLocale());
    }
}
