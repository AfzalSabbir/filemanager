<?php

namespace Backpack\FileManager;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    protected $commands = [
        \Backpack\FileManager\Console\Commands\Install::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'backpack');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'backpack');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/elfinder'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../config/elfinder.php'      => config_path('elfinder.php'),
        ], 'config');

        // Publishing Themes
        $this->publishes([
            __DIR__.'/../public/packages/backpack/filemanager/themes/Backpack'      => public_path('packages/backpack/filemanager/themes/Backpack'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../public/packages/backpack/filemanager/themes/DarkSlim'      => public_path('packages/backpack/filemanager/themes/DarkSlim'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../public/packages/backpack/filemanager/themes/Material'      => public_path('packages/backpack/filemanager/themes/Material'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../public/packages/backpack/filemanager/themes/Windows10'      => public_path('packages/backpack/filemanager/themes/Windows10'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../public/packages/backpack/filemanager/themes/Moono'      => public_path('packages/backpack/filemanager/themes/Moono'),
        ], 'public');

        // Registering package commands.
        $this->commands($this->commands);

        // Mapping the elfinder prefix, if missing
        if (! Config::get('elfinder.route.prefix')) {
            Config::set('elfinder.route.prefix', Config::get('backpack.base.route_prefix').'/elfinder');
        }
    }
}
