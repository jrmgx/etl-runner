<?php

namespace Jrmgx\Etl\Load\Push;

use Jrmgx\Etl\Config\PushConfig;

interface PushInterface
{
    public function push(mixed $resource, PushConfig $config): void;
}
