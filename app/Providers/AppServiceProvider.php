<?php

namespace App\Providers;

use Database\Populators\ClientPopulator;
use Database\Populators\StudentPopulator;
use Database\Populators\StudentRegistrationPopulator;
use Database\Seeders\Helpers\MakeFamilies;
use Illuminate\Database\Eloquent\Model;
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
        $this->app->bind(MakeFamilies::class, fn ($app) => new MakeFamilies(
            $app->make(ClientPopulator::class),
            $app->make(StudentPopulator::class),
            $app->make(StudentRegistrationPopulator::class)
        ));

        $this->app->bind(ClientPopulator::class, fn ($app) => new ClientPopulator);

        $this->app->bind(StudentPopulator::class, fn ($app) => new StudentPopulator);

        $this->app->bind(StudentRegistrationPopulator::class, fn ($app) => new StudentRegistrationPopulator);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventLazyLoading();
    }
}
