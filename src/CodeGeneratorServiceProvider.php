<?php

namespace DhavalRajput\CodeGenerator;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use DhavalRajput\CodeGenerator\Http\Livewire\Logs;
use DhavalRajput\CodeGenerator\Http\Livewire\Index;
use DhavalRajput\CodeGenerator\Http\Livewire\RestApi;

class CodeGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * Bind services, merge configuration, and register commands.
     */
    public function register(): void
    {
        // Merge package config with app config
        $this->mergeConfigFrom(
            __DIR__ . '/../config/code-generator.php',
            'code-generator'
        );

        // Register package artisan commands
        $this->commands([
            \DhavalRajput\CodeGenerator\Console\Commands\MakeModel::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeController::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeMigration::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakePolicy::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeObserver::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeFactory::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeService::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeNotification::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeRequest::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeResource::class,
            \DhavalRajput\CodeGenerator\Console\Commands\MakeResourceCollection::class,
            \DhavalRajput\CodeGenerator\Console\Commands\ClearLogs::class,
        ]);
    }


    public function boot(): void
    {
        if (!app()->environment(['local'])) {
            return;
        }

        // Publish views from package
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('code-generator'),
        ], 'code-generator-views');

        // Publish config file
        $this->publishes([
            __DIR__ . '/../config/code-generator.php' => config_path('code-generator.php'),
        ], 'code-generator-config');

        // Publish migration files
        $this->publishes([
            __DIR__ . '/Migrations' => database_path('migrations'),
        ], 'code-generator-migrations');

        // Publish stub files
        $this->publishes([
            __DIR__ . '/stubs' => database_path('stubs'),
        ], 'code-generator-stubs');

        // Load routes from package
        Route::middleware('web')
            ->group(__DIR__ . '/../routes/web.php');

        // Load migrations from package
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        // Load views from package
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'code-generator');

        // Register Livewire components
        Livewire::component('code-generator::index', Index::class);
        Livewire::component('code-generator::rest-api', RestApi::class);
        Livewire::component('code-generator::logs', Logs::class);
    }
}
