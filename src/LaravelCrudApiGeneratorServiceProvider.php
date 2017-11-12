<?php namespace Chbakouras\CrudApiGenerator;

use Chbakouras\CrudApiGenerator\Command\MakeCrudApiCommand;
use Illuminate\Support\ServiceProvider;

/**
 * @author Chrisostomos Bakouras
 */
class LaravelCrudApiGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel_crud_api_generator.php' => config_path('laravel_crud_api_generator.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravel-crud-api-generators.make-crud-api-command', function ($app) {
            return new MakeCrudApiCommand();
        });

        $this->commands([
            'laravel-crud-api-generators.make-crud-api-command',
        ]);
    }
}
