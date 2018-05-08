<?php

namespace App\Providers;

use App\Model\Posts\MongoPostRepository;
use App\Model\Posts\PostRepository;
use Illuminate\Support\ServiceProvider;
use MongoDB\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function($app) {
            return new Client(env('MONGO_URI'));
        });
        $this->app->singleton(PostRepository::class, function($app) {
            return new MongoPostRepository($app->make(Client::class));
        });
    }
}
