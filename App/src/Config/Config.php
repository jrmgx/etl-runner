<?php

namespace Jrmgx\Etl\Config;

class Config extends AbstractConfig
{
    public function getPullConfig(): PullConfig
    {
        return new PullConfig($this->config['extract']['pull']);
    }

    public function getReadConfig(): ReadConfig
    {
        return new ReadConfig($this->config['extract']['read']);
    }

    public function getMappingConfig(): MappingConfig
    {
        return new MappingConfig($this->config['transform']);
    }

    public function getPushConfig(): PushConfig
    {
        return new PushConfig($this->config['load']['push']);
    }

    public function getWriteConfig(): WriteConfig
    {
        return new WriteConfig($this->config['load']['write']);
    }


}
