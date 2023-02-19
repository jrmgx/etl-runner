<?php

namespace Jrmgx\Etl\Transform;

use Jrmgx\Etl\Config\MappingConfig;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem(index: 'simple')]
class SimpleTransform implements TransformInterface
{
    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function map(array $data, MappingConfig $config): array
    {
        // TODO handle expression + expression language
        return $data;
    }
}
