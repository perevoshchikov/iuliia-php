<?php

namespace Anper\Iuliia\Definition;

/**
 * Class Definition
 * @package Anper\Iuliia\Definition
 */
class Definition
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var array
     */
    protected $samples = [];

    /**
     * @var array
     */
    protected $map;

    /**
     * @var array
     */
    protected $prevMap;

    /**
     * @var array
     */
    protected $nextMap;

    /**
     * @var array
     */
    protected $endingMap;

    /**
     * @param string $filename
     *
     * @return static
     */
    public static function createFromFile(string $filename): self
    {
        $content = \Anper\Iuliia\file_get_contents($filename);
        $json = \Anper\Iuliia\json_decode($content);

        $self = new static(
            $json['mapping'] ?? [],
            $json['prev_mapping'] ?? [],
            $json['next_mapping'] ?? [],
            $json['ending_mapping'] ?? []
        );

        $self->setName($json['name'] ?? '')
            ->setDescription($json['description'] ?? '')
            ->setUrl($json['url'] ?? '')
            ->setSamples($json['samples'] ?? []);

        return $self;
    }

    /**
     * @param array $map
     * @param array $prevMap
     * @param array $nextMap
     * @param array $endingMap
     */
    public function __construct(
        array $map,
        array $prevMap,
        array $nextMap,
        array $endingMap
    ) {
        $this->map = $map;
        $this->prevMap = $prevMap;
        $this->nextMap = $nextMap;
        $this->endingMap = $endingMap;
    }

    /**
     * @return array
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * @return array
     */
    public function getPrevMap(): array
    {
        return $this->prevMap;
    }

    /**
     * @return array
     */
    public function getNextMap(): array
    {
        return $this->nextMap;
    }

    /**
     * @return array
     */
    public function getEndingMap(): array
    {
        return $this->endingMap;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function getSamples(): array
    {
        return $this->samples;
    }

    /**
     * @param array $samples
     *
     * @return $this
     */
    public function setSamples(array $samples): self
    {
        $this->samples = $samples;

        return $this;
    }
}
