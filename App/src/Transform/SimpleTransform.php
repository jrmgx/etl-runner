<?php

namespace Jrmgx\Etl\Transform;

use Jrmgx\Etl\Config\MappingConfig;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

#[AsTaggedItem(index: 'simple')]
class SimpleTransform implements TransformInterface
{
    private PropertyAccessorInterface $propertyAccessor;

    public function __construct()
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
            ->enableExceptionOnInvalidIndex()
            ->getPropertyAccessor();
    }

    /**
     * @param array<mixed> $lines
     * @return array<mixed>
     */
    public function map(array $lines, MappingConfig $config): array
    {
        $mapping = $config->getMapping();
        if (count($mapping) === 0) {
            return $lines; // identity
        }

        $keys = array_map(fn (string $k) => substr($k, 3), array_keys($mapping));
        $values = array_map(fn (string $v) => substr($v, 4), array_values($mapping));
        $mapping = array_combine($keys, $values);

        $result = [];

        foreach ($lines as $line) {
            $newLine = [];
            foreach ($mapping as $mappingIn => $mappingOut) {
                $obj = json_decode(json_encode($line)); // TODO could be better
                $newLine[$mappingOut] = $this->propertyAccessor->getValue($obj, $mappingIn);
            }
            $result[] = $newLine;
        }

        return $result;
    }
}
