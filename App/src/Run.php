<?php

namespace Jrmgx\Etl;

use Jrmgx\Etl\Config\Config;
use Jrmgx\Etl\Extract\Pull\PullInterface;
use Jrmgx\Etl\Extract\Read\ReadInterface;
use Jrmgx\Etl\Load\Push\PushInterface;
use Jrmgx\Etl\Load\Write\WriteInterface;
use Jrmgx\Etl\Transform\TransformInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Yaml\Yaml;
use Symfony\Contracts\Service\ServiceProviderInterface;

#[AsCommand(
    name: 'etl:run',
    description: 'Add a short description for your command',
)]
class Run extends Command
{
    public function __construct(
        private readonly ServiceProviderInterface $pullServices,
        private readonly ServiceProviderInterface $readServices,
        private readonly ServiceProviderInterface $transformServices,
        private readonly ServiceProviderInterface $writeServices,
        private readonly ServiceProviderInterface $pushServices,
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
        $config = new Config($configs);

        $extractPullType = $config->getPullConfig()->getType();
        /** @var PullInterface $extractPullService */
        $extractPullService = $this->pullServices->get($extractPullType);
        $readResource = $extractPullService->pull($config->getPullConfig());

        $extractReadFormat = $config->getReadConfig()->getFormat();
        /** @var ReadInterface $extractReadService */
        $extractReadService = $this->readServices->get($extractReadFormat);
        $read = $extractReadService->read($readResource, $config->getReadConfig());

        // TODO allow custom types
        $mappingType = $config->getMappingConfig()->getType();
        /** @var TransformInterface $mappingService */
        $mappingService = $this->transformServices->get($mappingType);
        $mapped = $mappingService->map($read, $config->getMappingConfig());

        $loadWriteFormat = $config->getWriteConfig()->getFormat();
        /** @var WriteInterface $loadWriteService */
        $loadWriteService = $this->writeServices->get($loadWriteFormat);
        $writeResource = $loadWriteService->write($mapped, $config->getWriteConfig());

        $loadPushType = $config->getPushConfig()->getType();
        /** @var PushInterface $loadPushService */
        $loadPushService = $this->pushServices->get($loadPushType);
        $loadPushService->push($writeResource, $config->getPushConfig());

//        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }
//
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
