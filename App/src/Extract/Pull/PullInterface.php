<?php

namespace Jrmgx\Etl\Extract\Pull;

use Jrmgx\Etl\Config\PullConfig;

interface PullInterface
{
    public function pull(PullConfig $config): mixed;
}
