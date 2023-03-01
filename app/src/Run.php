<?php

namespace Jrmgx\EtlRunner;

use Jrmgx\Etl\Config\Config;
use Jrmgx\Etl\Etl;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(
    name: 'etl:run',
    description: 'Run the configured ETL',
)]
class Run extends Command
{
    public function __construct(private readonly Etl $etl)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Yaml is optional, you can provide a basic array instead
        $configFile = Yaml::parseFile(__DIR__ . '/../../config.yaml');
        $config = new Config($configFile, __DIR__ . '/../../');

        $this->etl->execute($config);

        return Command::SUCCESS;
    }
}
