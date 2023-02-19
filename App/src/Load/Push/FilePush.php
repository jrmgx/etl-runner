<?php

namespace Jrmgx\Etl\Load\Push;

use Jrmgx\Etl\Config\PushConfig;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem(index: 'file')]
class FilePush implements PushInterface
{
    public function push(mixed $resource, PushConfig $config): void
    {
        $uri = $config->getUri();
        $projectRoot = realpath(__DIR__ .'/../../../../');
        $uri = preg_replace('`^\./`', $projectRoot . "/", $uri);

        file_put_contents($uri, $resource);
    }
}
