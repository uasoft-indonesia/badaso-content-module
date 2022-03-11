<?php

namespace Uasoft\Badaso\Module\Content\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Uasoft\Badaso\Module\Content\BadasoContentModule;
use Uasoft\Badaso\Module\Content\Commands\BadasoContentSetup;
use Uasoft\Badaso\Module\Content\Commands\BadasoContentTestSetup;
use Uasoft\Badaso\Module\Content\Facades\BadasoContentModule as FacadesBadasoContentModule;

class BadasoContentModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('BadasoContentModule', FacadesBadasoContentModule::class);

        $this->app->singleton('badaso-content-module', function () {
            return new BadasoContentModule();
        });

        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'badaso-content');

        $this->publishes([
            __DIR__.'/../Config/badaso-content.php' => config_path('badaso-content.php'),
            __DIR__.'/../Swagger' => app_path('Http/Swagger/swagger_models'),
            __DIR__.'/../Seeder' => database_path('seeders/Badaso/Content'),
        ], 'badaso-content-module');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommands();
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(BadasoContentSetup::class);
        $this->commands(BadasoContentTestSetup::class);
    }
}
