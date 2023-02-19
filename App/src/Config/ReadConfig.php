<?php

namespace Jrmgx\Etl\Config;

class ReadConfig extends AbstractConfig
{
    public function getFormat(): string
    {
        return $this->config['format'];
    }
}
