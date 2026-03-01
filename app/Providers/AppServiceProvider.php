<?php

namespace App\Providers;

use App\Repositories\Contracts\BloodTypeRepositoryInterface;
use App\Repositories\Contracts\ClinicalDataRepositoryInterface;
use App\Repositories\Contracts\EmergencyContactRepositoryInterface;
use App\Repositories\Contracts\GenderRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\BloodTypeRepository;
use App\Repositories\Eloquent\ClinicalDataRepository;
use App\Repositories\Eloquent\EmergencyContactRepository;
use App\Repositories\Eloquent\GenderRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(GenderRepositoryInterface::class, GenderRepository::class);
        $this->app->bind(BloodTypeRepositoryInterface::class, BloodTypeRepository::class);
        $this->app->bind(EmergencyContactRepositoryInterface::class, EmergencyContactRepository::class);
        $this->app->bind(ClinicalDataRepositoryInterface::class, ClinicalDataRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
