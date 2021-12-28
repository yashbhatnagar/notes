<?php

namespace App\Providers;

use App\Services\Interfaces\INoteService;
use App\Services\NoteService;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Service Registrations
        ==================================================*/
        $this->app->bind(INoteService::class, NoteService::class);
    }
}
