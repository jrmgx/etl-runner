<?php

namespace Jrmgx\Etl\Extract\Read;

use Jrmgx\Etl\Config\ReadConfig;

interface ReadInterface
{
    /**
     * @return array<mixed>
     */
    public function read(mixed $resource, ReadConfig $config): array;
}
