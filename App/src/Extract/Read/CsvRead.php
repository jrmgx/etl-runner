<?php

namespace Jrmgx\Etl\Extract\Read;

use Jrmgx\Etl\Config\ReadConfig;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem(index: 'csv')]
class CsvRead implements ReadInterface
{
    private const OPTIONS = [
        'trim' => false,
        'header' => false,
        'separator' => ',',
        'enclosure' => '"',
        'escape' => '\\',
    ];

    public function read(mixed $resource, ReadConfig $config): array
    {
        if (!is_string($resource)) {
            return []; // TODO error
        }

        foreach (self::OPTIONS as $name => $default) {
            $$name = $config->getOptions()[$name] ?? $default;
        }

        $data = [];
        $headerData = null;
        foreach (explode("\n", $resource) as $line) {
            $line = trim($line);
            if (strlen($line) === 0) {
                continue;
            }

            $d = str_getcsv($line, $separator, $enclosure, $escape);

            if ($trim) {
                $d = array_map(trim(...), $d);
            }

            if ($header === true && $headerData === null) {
                $headerData = $d;
            } else {
                if ($headerData !== null) {
                    $d = array_combine($headerData, $d);
                }
                $data[] = $d;
            }
        }

        return $data;
    }
}
