<?php

namespace Jrmgx\Etl\Extract\Read;

interface ReadInterface
{
    /**
     * @return array<mixed>
     */
    public function read(mixed $resource, ReadConfig $config): array;
}
