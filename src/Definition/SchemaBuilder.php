<?php

namespace Anper\Iuliia\Definition;

use Anper\Iuliia\Map;
use Anper\Iuliia\Schema;

use function Anper\Iuliia\mb_ucfirst;

/**
 * Class SchemaBuilder
 * @package Anper\Iuliia\Definition
 */
class SchemaBuilder
{
    /**
     * @var array
     */
    protected $defaultMap = [];

    /**
     * @var array
     */
    protected $prevMap = [];

    /**
     * @var array
     */
    protected $nextMap = [];

    /**
     * @var array
     */
    protected $endingMap = [];

    /**
     * @param Definition $definition
     *
     * @return Schema
     */
    public function build(Definition $definition): Schema
    {
        $this->defaultMap = $definition->getMap();
        $this->endingMap = $definition->getEndingMap();
        $this->prevMap = $definition->getPrevMap();
        $this->nextMap = $definition->getNextMap();

        foreach ($this->defaultMap as $key => $value) {
            $this->defaultMap[mb_ucfirst($key)] = mb_ucfirst($value);
        }

        foreach ($this->prevMap as $key => $value) {
            $this->prevMap[mb_ucfirst($key)] = $value;
            $this->prevMap[\mb_strtoupper($key)] = mb_ucfirst($value);
        }

        foreach ($this->nextMap as $key => $value) {
            $this->nextMap[mb_ucfirst($key)] = mb_ucfirst($value);
            $this->nextMap[\mb_strtoupper($key)] = mb_ucfirst($value);
        }

        foreach ($this->endingMap as $key => $value) {
            $this->endingMap[\mb_strtoupper($key)] = \mb_strtoupper($value);
        }

        return new Schema(
            new Map($this->defaultMap),
            new Map($this->prevMap),
            new Map($this->nextMap),
            new Map($this->endingMap),
            $definition->getSamples()
        );
    }
}
