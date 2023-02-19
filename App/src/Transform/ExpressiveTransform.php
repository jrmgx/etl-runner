<?php

namespace Jrmgx\Etl\Transform;

use Jrmgx\Etl\Config\MappingConfig;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

#[AsTaggedItem(index: 'expressive')]
class ExpressiveTransform implements TransformInterface
{
    private ExpressionLanguage $expressionLanguage;

    public function __construct()
    {
        $this->expressionLanguage = new ExpressionLanguage();
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

        $keys = array_map(fn (string $k) => substr($k, 4), array_keys($mapping));
        $mapping = array_combine($keys, array_values($mapping));

        $result = [];

        foreach ($lines as $line) {
            $newLine = [];
            foreach ($mapping as $mappingOut => $mappingIn) {
                // TODO could be better
                $obj = json_decode(json_encode($line));
                $newLine[$mappingOut] = $this->expressionLanguage->evaluate($mappingIn, [
                    'in' => $obj,
                ]);
            }
            $result[] = $newLine;
        }

        return $result;
    }
}
