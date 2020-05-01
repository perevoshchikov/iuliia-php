<?php

namespace Anper\Iuliia;

/**
 * Class Schema
 * @package Anper\Iuliia
 */
class Schema
{
    /**
     * @var Map
     */
    protected $defaultMap;

    /**
     * @var Map
     */
    protected $prevMap;

    /**
     * @var Map
     */
    protected $nextMap;

    /**
     * @var Map
     */
    protected $endingMap;

    /**
     * @var array
     */
    protected $samples;

    /**
     * @param string $filename
     *
     * @return static
     */
    public static function createFromFile(string $filename): self
    {
        $data = (array) include_file($filename);

        return new static(
            new Map($data[0] ?? []),
            new Map($data[1] ?? []),
            new Map($data[2] ?? []),
            new Map($data[3] ?? []),
            $data[4] ?? []
        );
    }

    /**
     * @param Map $defaultMap
     * @param Map $prevMap
     * @param Map $nextMap
     * @param Map $endingMap
     * @param array $samples
     */
    public function __construct(
        Map $defaultMap,
        Map $prevMap,
        Map $nextMap,
        Map $endingMap,
        array $samples = []
    ) {
        $this->defaultMap = $defaultMap;
        $this->prevMap = $prevMap;
        $this->nextMap = $nextMap;
        $this->endingMap = $endingMap;
        $this->samples = $samples;
    }

    /**
     * @return Map
     */
    public function getDefaultMap(): Map
    {
        return $this->defaultMap;
    }

    /**
     * @return Map
     */
    public function getPrevMap(): Map
    {
        return $this->prevMap;
    }

    /**
     * @return Map
     */
    public function getNextMap(): Map
    {
        return $this->nextMap;
    }

    /**
     * @return Map
     */
    public function getEndingMap(): Map
    {
        return $this->endingMap;
    }

    /**
     * @return array
     */
    public function getSamples(): array
    {
        return $this->samples;
    }
}
