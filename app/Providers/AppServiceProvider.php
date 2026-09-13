<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Desa;

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
        // Mengirim variabel $desa ke semua view
        View::composer('*', function ($view) {
            $desa = Desa::find(1); // Sesuaikan ID dengan data yang ada
            $view->with('desa', $desa);
        });
    }
}
