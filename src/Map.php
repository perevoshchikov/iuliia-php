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
     * @return array
     */
    public function all(): array
    {
        return $this->data;
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
