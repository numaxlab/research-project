<?php


namespace NumaxLab\ResearchProject\Providers;

use Illuminate\Support\ServiceProvider;
use NumaxLab\ResearchProject\Commands\Install;

class ResearchProjectServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('research-project.php'),
            __DIR__ . '/../../lang' => $this->app->langPath('vendor/research-project'),

        ]);
        $this->loadRoutesFrom(__DIR__ . '/../../routes/research-project.php');
        /*  $this->publishesMigrations([
              __DIR__ . '/../../database/migrations' => database_path('migrations'),
          ]);*/

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        //pq load e non publishes

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'research-project');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'research-project'
        );
    }
}
