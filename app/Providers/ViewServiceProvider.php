<?php

namespace App\Providers;
use App\Models\TestSelect;

use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['test_selects.fields'], function ($view) {
            $test_selectItems = TestSelect::pluck('name','id')->toArray();
            $view->with('test_selectItems', $test_selectItems);
        });
        //
    }
}