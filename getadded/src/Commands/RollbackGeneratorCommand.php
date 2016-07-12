<?php

namespace Ayim\Generator\Commands;

use Ayim\Generator\Common\CommandData;
use Ayim\Generator\Generators\API\APIControllerGenerator;
use Ayim\Generator\Generators\API\APIRequestGenerator;
use Ayim\Generator\Generators\API\APIRoutesGenerator;
use Ayim\Generator\Generators\API\APITestGenerator;
use Ayim\Generator\Generators\MigrationGenerator;
use Ayim\Generator\Generators\ModelGenerator;
use Ayim\Generator\Generators\RepositoryGenerator;
use Ayim\Generator\Generators\RepositoryTestGenerator;
use Ayim\Generator\Generators\Scaffold\ControllerGenerator;
use Ayim\Generator\Generators\Scaffold\MenuGenerator;
use Ayim\Generator\Generators\Scaffold\RequestGenerator;
use Ayim\Generator\Generators\Scaffold\RoutesGenerator;
use Ayim\Generator\Generators\Scaffold\ViewGenerator;
use Ayim\Generator\Generators\TestTraitGenerator;
use Ayim\Generator\Generators\VueJs\ControllerGenerator as VueJsControllerGenerator;
use Ayim\Generator\Generators\VueJs\ModelJsConfigGenerator;
use Ayim\Generator\Generators\VueJs\RoutesGenerator as VueJsRoutesGenerator;
use Ayim\Generator\Generators\VueJs\ViewGenerator as VueJsViewGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RollbackGeneratorCommand extends Command
{
    /**
     * The command Data.
     *
     * @var CommandData
     */
    public $commandData;


    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ayim:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback a full CRUD API and Scaffold for given model';

    /**
     * @var Composer
     */
    public $composer;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->composer = app()['composer'];
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        if (!in_array($this->argument('type'), [
            CommandData::$COMMAND_TYPE_API,
            CommandData::$COMMAND_TYPE_SCAFFOLD,
            CommandData::$COMMAND_TYPE_API_SCAFFOLD,
            CommandData::$COMMAND_TYPE_VUEJS,
        ])) {
            $this->error('invalid rollback type');
        }
        $this->commandData = new CommandData($this, $this->argument('type'));
        $this->commandData->config->mName = $this->commandData->modelName = $this->argument('model');

        $this->commandData->config->prepareOptions($this->commandData, ['tableName', 'prefix']);
        $this->commandData->config->prepareAddOns();

        $this->commandData->config->prepareModelNames();
        $this->commandData->config->prepareTableName();

        $this->commandData->config->loadPaths();
        $this->commandData->config->loadNamespaces($this->commandData);

        $this->commandData = $this->commandData->config->loadDynamicVariables($this->commandData);
        $migrationGenerator = new MigrationGenerator($this->commandData);
        $migrationGenerator->rollback();
        $modelGenerator = new ModelGenerator($this->commandData);
        $modelGenerator->rollback();

        $repositoryGenerator = new RepositoryGenerator($this->commandData);
        $repositoryGenerator->rollback();

        $requestGenerator = new APIRequestGenerator($this->commandData);
        $requestGenerator->rollback();

        $controllerGenerator = new APIControllerGenerator($this->commandData);
        $controllerGenerator->rollback();

        $routesGenerator = new APIRoutesGenerator($this->commandData);
        $routesGenerator->rollback();

        $requestGenerator = new RequestGenerator($this->commandData);
        $requestGenerator->rollback();

        $controllerGenerator = new ControllerGenerator($this->commandData);
        $controllerGenerator->rollback();

        $viewGenerator = new ViewGenerator($this->commandData);
        $viewGenerator->rollback();

        $routeGenerator = new RoutesGenerator($this->commandData);
        $routeGenerator->rollback();

//        $controllerGenerator = new VueJsControllerGenerator($this->commandData);
//        $controllerGenerator->rollback();
//
//        $routesGenerator = new VueJsRoutesGenerator($this->commandData);
//        $routesGenerator->rollback();
//
//        $viewGenerator = new VueJsViewGenerator($this->commandData);
//        $viewGenerator->rollback();
//
//        $modelJsConfigGenerator = new ModelJsConfigGenerator($this->commandData);
//        $modelJsConfigGenerator->rollback();

        if ($this->commandData->getAddOn('tests')) {
            $repositoryTestGenerator = new RepositoryTestGenerator($this->commandData);
            $repositoryTestGenerator->rollback();
            $testTraitGenerator = new TestTraitGenerator($this->commandData);
            $testTraitGenerator->rollback();
            $apiTestGenerator = new APITestGenerator($this->commandData);
            $apiTestGenerator->rollback();
        }

        if ($this->commandData->config->getAddOn('menu.enabled')) {
            $menuGenerator = new MenuGenerator($this->commandData);
            $menuGenerator->rollback();
        }
        $this->info('Generating autoload files');
        $this->composer->dumpOptimized();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            ['tableName', null, InputOption::VALUE_REQUIRED, 'Table Name'],
            ['prefix', null, InputOption::VALUE_REQUIRED, 'Prefix for all files'],
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'Singular Model name'],
            ['type', InputArgument::REQUIRED, 'Rollback type: (api / scaffold / scaffold_api)'],
        ];
    }
}
