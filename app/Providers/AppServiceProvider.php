<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{

    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cart_count = 0;
    
            if (Auth::check()) {
                $user_id = Auth::id();
                $cart_count = Cart::where('user_id', $user_id)->sum('jumlah');
            }
    
            $view->with('cart_count', $cart_count);
        });
    }
}
