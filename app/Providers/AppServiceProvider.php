<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            if (Auth::guard('employee')->check()) {
                $user = Auth::guard('employee')->user();
                $view->with([
                    'notifikasiList' => $user->notifications()->latest()->take(5)->get(),
                    'notifikasiCount' => $user->unreadNotifications()->count(),
                ]);
            }
        });
    }
}
