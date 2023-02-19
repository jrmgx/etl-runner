<?php

namespace Jrmgx\Etl\Config;

class MappingConfig extends AbstractConfig
{
    /**
     * @return array<mixed>
     */
    public function getMapping(): array
    {
        return $this->config;
    }
}
