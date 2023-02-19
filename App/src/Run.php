<?php

namespace Jrmgx\Etl;

use Jrmgx\Etl\Config\MappingConfig;
use Jrmgx\Etl\Config\PullConfig;
use Jrmgx\Etl\Config\PushConfig;
use Jrmgx\Etl\Config\ReadConfig;
use Jrmgx\Etl\Config\WriteConfig;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(
    name: 'etl:run',
    description: 'Add a short description for your command',
)]
class Run extends Command
{
    public function __construct(

    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $configs = Yaml::parseFile(__DIR__.'/../../config.yaml');

        $configExtractPull = new PullConfig($configs['extract']['pull']);
        $configExtractRead = new ReadConfig($configs['extract']['read']);
        $configMapping = new MappingConfig($configs['transform']['mapping'] ?? []);
        $configLoadPush = new PushConfig($configs['load']['push']);
        $configLoadWrite = new WriteConfig($configs['load']['write']);

        dump(
            $configExtractPull,
            $configExtractRead,
            $configMapping,
            $configLoadPush,
            $configLoadWrite,
        );

        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }



        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
