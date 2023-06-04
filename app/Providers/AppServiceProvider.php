<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\EloquentUserRepository;
use App\Services\AuthService;
use App\Services\AuthServiceInterface;
use App\Repositories\KendaraanRepository;
use App\Repositories\KendaraanSelectionRepository;
use App\Repositories\PenjualanRepositoryInterface;
use App\Repositories\PenjualanRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(KendaraanRepository::class, KendaraanSelectionRepository::class);
        $this->app->bind(PenjualanRepositoryInterface::class, PenjualanRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
