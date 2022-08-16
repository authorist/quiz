<?php

namespace App\Providers;

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
        //
    }
}
// Migration’larda tanımlanan değerler için Laravel’in varsayılan şema boyutları yetersiz kalabiliyor. 
// Bu durumun çözümü oldukça basit “AppServiceProvider.php” dosyamızı buluyoruz. Dosyamızın içerisinde
//  yer alan “boot()” methodu içerisine  Schema::defaultStringLength(191);