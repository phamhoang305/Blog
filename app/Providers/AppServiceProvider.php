<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Views\CountAdmin;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // View::composer('admin.includes.sidebar', function($view) {
        //     $countData = CountAdmin::all();
        //     $data = new \stdClass;
        //     foreach ($countData as $item) {
        //             $data->{$item->KEY} = $item->VALUE;
        //     }
        //     $view->with('shareAdmin', $data);
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
