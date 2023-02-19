<?php

namespace Jrmgx\Etl\Config;

class WriteConfig extends AbstractConfig
{
    public function getFormat(): string
    {
        return $this->config['format'];
    }
}
