<?php

namespace Jrmgx\Etl\Transform;

use Jrmgx\Etl\Config\MappingConfig;

interface TransformInterface
{
    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function map(array $data, MappingConfig $config): array;
}
