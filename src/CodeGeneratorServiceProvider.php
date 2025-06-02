<?php

namespace Dhaval\CodeGenerator;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Dhaval\CodeGenerator\Http\Livewire\Index;
use Dhaval\CodeGenerator\Http\Livewire\Logs;
use Dhaval\CodeGenerator\Http\Livewire\RestApi;

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
            __DIR__ . '/../config/code_generator.php',
            'code_generator'
        );

        // Register package artisan commands
        $this->commands([
            \Dhaval\CodeGenerator\Console\Commands\MakeModel::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeController::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeMigration::class,
            \Dhaval\CodeGenerator\Console\Commands\MakePolicy::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeObserver::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeFactory::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeService::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeNotification::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeRequest::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeResource::class,
            \Dhaval\CodeGenerator\Console\Commands\MakeResourceCollection::class,
            \Dhaval\CodeGenerator\Console\Commands\ClearLogs::class,
        ]);
    }


    public function boot(): void
    {
        // Define middleware group for the code generator routes
        Route::middlewareGroup(
            'codeGeneratorMiddleware',
            config('code_generator.middleware', [])
        );

        // Publish views from package
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('code-generator'),
        ], 'code-generator-views');

        // Publish config file
        $this->publishes([
            __DIR__ . '/../config/code_generator.php' => config_path('code_generator.php'),
        ], 'config');

        // Publish migration files
        $this->publishes([
            __DIR__ . '/Migrations' => database_path('migrations'),
        ], 'codegenerator-migrations');

        // Publish stub files
        $this->publishes([
            __DIR__ . '/stubs' => database_path('stubs'),
        ], 'stubs');

        // Load routes from package
        $this->loadRoutesFrom(__DIR__ . "/../routes/web.php");

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
