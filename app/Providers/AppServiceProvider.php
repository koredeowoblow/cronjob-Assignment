<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\NotifyFansOfNewPost;
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
        //
        $this->app->singleton(NotifyFansOfNewPost::class);
    }
}
