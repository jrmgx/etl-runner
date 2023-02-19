<?php

namespace Jrmgx\Etl\Load\Write;

interface WriteInterface
{
    /**
     * @param array<mixed> $data
     * @return mixed
     */
    public function write(array $data, WriteConfig $config): mixed;
}
