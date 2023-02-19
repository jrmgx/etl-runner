<?php

namespace Jrmgx\Etl\Config;

class MappingConfig extends AbstractConfig
{
    public function getType(): string
    {
        return $this->config['type'];
    }

    /**
     * @return array<mixed>
     */
    public function getMapping(): array
    {
        return $this->config['mapping'];
    }
}
