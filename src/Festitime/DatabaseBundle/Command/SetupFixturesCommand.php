<?php

namespace Festitime\DatabaseBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SetupFixturesCommand extends Command
{

    protected $commandList = array(
        'doctrine:mongodb:schema:drop',
        'doctrine:mongodb:schema:create',
        'khepin:yamlfixtures:load',
        'festitime:fixtures:link'
    );

    protected function configure()
    {
        $this
            ->setName('festitime:fixtures:setup')
            ->setDescription('Remove current database and recreate one with fixtures linked')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $progressBar = $this->getHelperSet()->get('progress');
        $progressBar->start($output, 4);
        foreach ($this->commandList as $commandName) {
            $command = $this->getApplication()->find($commandName);
            $arguments = array(
                'command' => $commandName,
            );
            $input = new ArrayInput($arguments);
            $command->run($input, $output);
            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
