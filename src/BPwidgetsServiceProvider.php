<?php

namespace shinokada\BPwidgets;

use Illuminate\Support\ServiceProvider;

class BPwidgetsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'shinokada');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'shinokada');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__ . '/../config/bpwidgets.php' => config_path('bpwidgets.php'),
            ], 'bpwidgets.config');

            // Publishing the views.
            /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/shinokada'),
            ], 'bpwidgets.views');*/

            // Publishing assets.
            /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/shinokada'),
            ], 'bpwidgets.views');*/

            // Publishing the translation files.
            /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/shinokada'),
            ], 'bpwidgets.views');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/bpwidgets.php', 'bpwidgets');

        // Register the service the package provides.
        $this->app->singleton('bpwidgets', function ($app) {
            return new BPwidgets;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['bpwidgets'];
    }
}
