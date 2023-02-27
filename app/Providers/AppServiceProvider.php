<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        
        view()->composer('*', function ($view){
            if(isset(Auth::user()->id)){
                $id = Auth::user()->id;
            }else{
                $id = 0;
            }
            $winkelwagenItems = DB::table('shopping_cards')
                ->where('shopping_cards.user_id', $id)
                ->get();
            $view->with('winkelwagenItems',$winkelwagenItems);
        });
    }
}
