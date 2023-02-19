<?php

namespace Jrmgx\Etl\Extract\Pull;

interface PullInterface
{
    public function pull(PullConfig $config): mixed;
}
