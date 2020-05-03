<?php

namespace Anper\Iuliia\Tests\Schema;

use Anper\Iuliia\Iuliia;
use Anper\Iuliia\Schema;
use PHPUnit\Framework\TestCase;

class IuliiaTest extends TestCase
{
    protected function getSchema(): Schema
    {
        $build = __DIR__
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
            . 'build'
            . DIRECTORY_SEPARATOR
            . Iuliia::WIKIPEDIA
            . '.php';

        return Schema::createFromFile($build);
    }

    public function testSchema(): void
    {
        $schema = Iuliia::schema(Iuliia::WIKIPEDIA);

        $this->assertEquals($this->getSchema(), $schema);
    }

    public function testSchemaNotFound(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Iuliia::schema('not-exists-schema');
    }

    public function testEngine(): void
    {
        $engine = Iuliia::engine(Iuliia::WIKIPEDIA);

        $this->assertEquals($this->getSchema(), $engine->getSchema());
    }

    public function testTranslate(): void
    {
        $str = 'Юлия Щербакова';

        $engine = Iuliia::engine(Iuliia::WIKIPEDIA);
        $translated = Iuliia::translate($str, Iuliia::WIKIPEDIA);

        $this->assertEquals($engine->translate($str), $translated);
    }
}
