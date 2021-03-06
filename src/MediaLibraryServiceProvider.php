<?php

namespace Ayim\MediaLibrary;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;
use Ayim\MediaLibrary\Commands\ClearCommand;
use Ayim\MediaLibrary\Commands\RegenerateCommand;
use Ayim\MediaLibrary\Commands\CheckExistenceCommand;

class MediaLibraryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication) {
            $this->publishes([
                __DIR__ . '/../config/mediaManager.php' => config_path('mediaManager.php'),
            ], 'config');

            if (!class_exists('CreateMediaTable')) {
                // Publish the migration
                $timestamp = date('Y_m_d_His', time());

                $this->publishes([
                    __DIR__.'/../database/migrations/create_media_table.php.stub' => database_path('migrations/'.$timestamp.'_create_media_table.php'),
                  ], 'migrations');
            }
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('laravel-medialibrary');
        }

        $mediaClass = config('laravel-medialibrary.media_model');
        $mediaClass::observe(new MediaObserver());
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mediaManager.php', 'laravel-medialibrary');

        $this->app->singleton(MediaRepository::class);

        $this->app->bind('command.medialibrary:regenerate', RegenerateCommand::class);
        $this->app->bind('command.medialibrary:clear', ClearCommand::class);
        $this->app->bind('command.medialibrary:checkExistence', CheckExistenceCommand::class);

        $this->commands([
            'command.medialibrary:regenerate',
            'command.medialibrary:clear',
            'command.medialibrary:checkExistence'
        ]);
    }
}
