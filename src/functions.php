<?php

namespace Anper\Iuliia;

/**
 * @param string $str
 *
 * @return string
 */
function mb_ucfirst(string $str): string
{
    if (\mb_strlen($str) < 2) {
        return \mb_strtoupper($str);
    }

    $first = \mb_substr($str, 0, 1);
    $last = \mb_substr($str, 1);

    return \mb_strtoupper($first) . \mb_strtolower($last);
}

/**
 * @param string $json
 * @param bool $assoc
 *
 * @return array|mixed
 */
function json_decode(string $json, bool $assoc = true)
{
    $data = \json_decode($json, $assoc);

    if (JSON_ERROR_NONE !== json_last_error()) {
        throw new \RuntimeException(\json_last_error_msg(), \json_last_error());
    }

    return $data;
}

/**
 * @param string $filename
 *
 * @return string
 */
function file_get_contents(string $filename): string
{
    if (\file_exists($filename) === false || \is_file($filename) === false) {
        throw new \InvalidArgumentException("File '$filename' not found");
    }

    $content = \file_get_contents($filename);

    if ($content === false) {
        throw new \RuntimeException("Error read the contents of the file
 '$filename'");
    }

    return $content;
}

/**
 * @param string $filename
 *
 * @return mixed
 */
function include_file(string $filename)
{
    if (\file_exists($filename) === false || \is_file($filename) === false) {
        throw new \InvalidArgumentException("File '$filename' not found");
    }

    $content = @include $filename;

    if (empty($content)) {
        throw new \RuntimeException("Error read the contents of the file
 '$filename'");
    }

    return $content;
}
