<?php

namespace App\Providers;

use App\Repositories\ClientesEloquentORM;
use App\Repositories\PedidosEloquentORM;
use App\Repositories\PedidosRepositoryInterface;
use App\Repositories\SupportEloquentORM;
use App\Repositories\SupportRepositoryInterface;
use App\Repositories\ClientesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SupportRepositoryInterface::class, SupportEloquentORM::class);
        $this->app->bind(ClientesRepositoryInterface::class, ClientesEloquentORM::class);
        $this->app->bind(PedidosRepositoryInterface::class, PedidosEloquentORM::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
