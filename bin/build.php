<?php

$root = __DIR__
    . DIRECTORY_SEPARATOR
    . '..'
    . DIRECTORY_SEPARATOR;

require $root
    . 'vendor'
    . DIRECTORY_SEPARATOR
    . 'autoload.php';

use Anper\Iuliia\Iuliia;

use function Anper\Iuliia\mb_ucfirst;

$buildPath = $root
    . 'build'
    . DIRECTORY_SEPARATOR;

$schemasPath = $root
    . 'schemas'
    . DIRECTORY_SEPARATOR;

foreach (Iuliia::SCHEMAS as $schemaId => $basename) {
    $content = \file_get_contents($schemasPath . $basename . '.json');
    $definition = \json_decode($content, true);

    $defaultMap = $definition['mapping'] ?? [];
    $prevMap = $definition['prev_mapping'] ?? [];
    $nextMap = $definition['next_mapping'] ?? [];
    $endingMap = $definition['ending_mapping'] ?? [];

    foreach ($defaultMap as $key => $value) {
        $defaultMap[mb_ucfirst($key)] = mb_ucfirst($value);
    }

    foreach ($prevMap as $key => $value) {
        $prevMap[mb_ucfirst($key)] = $value;
        $prevMap[\mb_strtoupper($key)] = mb_ucfirst($value);
    }

    foreach ($nextMap as $key => $value) {
        $nextMap[mb_ucfirst($key)] = mb_ucfirst($value);
        $nextMap[\mb_strtoupper($key)] = mb_ucfirst($value);
    }

    foreach ($endingMap as $key => $value) {
        $endingMap[\mb_strtoupper($key)] = \mb_strtoupper($value);
    }

    $data = [
        $defaultMap,
        $prevMap,
        $nextMap,
        $endingMap,
        $definition['samples'] ?? [],
    ];

    $content = '<?php return ' . \var_export($data, true) . ';';

    $filepath = $buildPath . $basename . '.php';

    \file_put_contents($filepath, $content);

    \printf("%s \n", \realpath($filepath));
}
