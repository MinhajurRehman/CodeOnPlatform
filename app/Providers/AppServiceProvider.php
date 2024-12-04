<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\solutions;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;



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
    public function boot()
    {
        Post::observe(PostObserver::class);
        solutions::observe(CommentObserver::class);
    }
}