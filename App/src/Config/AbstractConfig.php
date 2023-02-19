<?php

namespace Jrmgx\Etl\Config;

abstract class AbstractConfig
{
    /**
     * @param array<mixed> $config
     */
    public function __construct(protected readonly array $config)
    {
    }

    /**
     * @return array<mixed>
     */
    public function getOptions(): array
    {
        return $this->config['options'] ?? [];
    }
}
