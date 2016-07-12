<?php

namespace Ayim\Generator;

use Ayim\Generator\Commands\API\APIControllerGeneratorCommand;
use Ayim\Generator\Commands\API\APIGeneratorCommand;
use Ayim\Generator\Commands\API\APIRequestsGeneratorCommand;
use Ayim\Generator\Commands\API\TestsGeneratorCommand;
use Ayim\Generator\Commands\APIScaffoldGeneratorCommand;
use Ayim\Generator\Commands\Common\MigrationGeneratorCommand;
use Ayim\Generator\Commands\Common\ModelGeneratorCommand;
use Ayim\Generator\Commands\Common\RepositoryGeneratorCommand;
use Ayim\Generator\Commands\Publish\GeneratorPublishCommand;
use Ayim\Generator\Commands\Publish\LayoutPublishCommand;
use Ayim\Generator\Commands\Publish\PublishTemplateCommand;
use Ayim\Generator\Commands\RollbackGeneratorCommand;
use Ayim\Generator\Commands\Scaffold\ControllerGeneratorCommand;
use Ayim\Generator\Commands\Scaffold\RequestsGeneratorCommand;
use Ayim\Generator\Commands\Scaffold\ScaffoldGeneratorCommand;
use Ayim\Generator\Commands\Scaffold\ViewsGeneratorCommand;
use Illuminate\Support\ServiceProvider;

class AyimGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //        determine how the config is published

        $configPath = __DIR__.'/../config/ayim_generator.php';
        $this->publishes([
            $configPath => config_path('ayim/ayim_generator.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('ayim.publish', function ($app) {
            return new GeneratorPublishCommand();
        });

        $this->app->singleton('ayim.api', function ($app) {
            return new APIGeneratorCommand();
        });

        $this->app->singleton('ayim.scaffold', function ($app) {
            return new ScaffoldGeneratorCommand();
        });

        $this->app->singleton('ayim.publish.layout', function ($app) {
            return new LayoutPublishCommand();
        });

        $this->app->singleton('ayim.publish.templates', function ($app) {
            return new PublishTemplateCommand();
        });
        $this->app->singleton('ayim.api_scaffold', function ($app) {
            return new APIScaffoldGeneratorCommand();
        });

        $this->app->singleton('ayim.migration', function ($app) {
            return new MigrationGeneratorCommand();
        });

        $this->app->singleton('ayim.model', function ($app) {
            return new ModelGeneratorCommand();
        });

        $this->app->singleton('ayim.repository', function ($app) {
            return new RepositoryGeneratorCommand();
        });

        $this->app->singleton('ayim.api.controller', function ($app) {
            return new APIControllerGeneratorCommand();
        });

        $this->app->singleton('ayim.api.requests', function ($app) {
            return new APIRequestsGeneratorCommand();
        });

        $this->app->singleton('ayim.api.tests', function ($app) {
            return new TestsGeneratorCommand();
        });

        $this->app->singleton('ayim.scaffold.controller', function ($app) {
            return new ControllerGeneratorCommand();
        });

        $this->app->singleton('ayim.scaffold.requests', function ($app) {
            return new RequestsGeneratorCommand();
        });

        $this->app->singleton('ayim.scaffold.views', function ($app) {
            return new ViewsGeneratorCommand();
        });

        $this->app->singleton('ayim.rollback', function ($app) {
            return new RollbackGeneratorCommand();
        });

//        $this->app->singleton('ayim.vuejs', function ($app) {
//            return new VueJsGeneratorCommand();
//        });

//        $this->app->singleton('ayim.publish.vuejs', function ($app) {
//            return new VueJsLayoutPublishCommand();
//        });

        $this->commands([
            'ayim.publish',
            'ayim.api',
            'ayim.scaffold',
            'ayim.api_scaffold',
            'ayim.publish.layout',
            'ayim.publish.templates',
            'ayim.migration',
            'ayim.model',
            'ayim.repository',
            'ayim.api.controller',
            'ayim.api.requests',
            'ayim.api.tests',
            'ayim.scaffold.controller',
            'ayim.scaffold.requests',
            'ayim.scaffold.views',
            'ayim.rollback',
//            'ayim.vuejs',
//            'ayim.publish.vuejs'
        ]);
    }
}
