<?php

namespace Anper\Iuliia;

/**
 * Class Map
 * @package Anper\Iuliia
 */
class Map
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param string|null $default
     *
     * @return string|null
     */
    public function get(string $key, ?string $default = ''): ?string
    {
        return $this->data[$key] ?? $default;
    }
}
