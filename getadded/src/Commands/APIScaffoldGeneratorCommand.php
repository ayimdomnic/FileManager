<?php

namespace Ayim\Generator\Commands;

class APIScaffoldGeneratorCommand extends BaseCommand
{
    protected $name = 'ayim:api_scafold';


    protected $description = 'Cread a full CRUD API scaffold for a given model';

    public function __construct()
    {
        parent::__construct();
        $this->commandData = new CommandData($this, CommandData::$COMMAND_TYPE_API_SCAFFOLD);
    }

    public function handle()
    {
        parent::handle();

        $this->generateCommonItems();

        $this->generateAPIItems();

        $this->generateScaffoldItems();

        $this->performPostActionsWithMigration();
    }

    public function getOptions()
    {
        return array_merge(parent::getOptions(), []);
    }

    public function getArguments()
    {
        return array_merge(parent::getArguments, []);
    }
}
