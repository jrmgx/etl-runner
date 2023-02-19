<?php

namespace Jrmgx\Etl\Extract\Pull;

use Jrmgx\Etl\Config\PullConfig;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem(index: 'file')]
class FilePull implements PullInterface
{
    public function pull(PullConfig $config): mixed
    {
        $uri = $config->getUri();
        $projectRoot = realpath(__DIR__ .'/../../../../');
        $uri = preg_replace('`^\./`', $projectRoot . "/", $uri);

        return file_get_contents($uri);
    }
}
