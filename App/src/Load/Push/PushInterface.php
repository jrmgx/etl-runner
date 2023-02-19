<?php

namespace Jrmgx\Etl\Load\Push;

interface PushInterface
{
    public function push(mixed $resource, PushConfig $config): void;
}
