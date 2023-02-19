<?php

namespace Jrmgx\Etl\Config;

class PullConfig extends AbstractConfig
{
    public function getType(): string
    {
        return $this->config['type'];
    }

    public function getUri(): string
    {
        return $this->config['uri'];
    }
}
