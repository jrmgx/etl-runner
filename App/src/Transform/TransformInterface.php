<?php

namespace Jrmgx\Etl\Transform;

use Jrmgx\Etl\Config\TransformConfig;

interface TransformInterface
{
    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function map(array $data, TransformConfig $config): array;
}
