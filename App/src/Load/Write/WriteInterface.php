<?php

namespace Jrmgx\Etl\Load\Write;

use Jrmgx\Etl\Config\WriteConfig;

interface WriteInterface
{
    /**
     * @param array<mixed> $data
     * @return mixed
     */
    public function write(array $data, WriteConfig $config): mixed;
}
