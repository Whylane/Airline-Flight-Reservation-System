<?php

namespace App\Providers;

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $notificationController = app(NotificationController::class);
        $userNotification = $notificationController->getUserNotifications();

        View::share('userNotification', $userNotification);
    }
}
