<?php

namespace Anper\Iuliia\Tests\Schema;

use Anper\Iuliia\Map;
use Anper\Iuliia\Schema;
use PHPUnit\Framework\TestCase;

class SchemaTest extends TestCase
{
    public function testGetMaps(): void
    {
        $default = new Map(['d' => 'd']);
        $prev = new Map(['p' => 'p']);
        $next = new Map(['n' => 'n']);
        $ending = new Map(['e' => 'e']);
        $samples = ['s' => 's'];

        $schema = new Schema($default, $prev, $next, $ending, $samples);

        $this->assertEquals($default, $schema->getDefaultMap());
        $this->assertEquals($prev, $schema->getPrevMap());
        $this->assertEquals($next, $schema->getNextMap());
        $this->assertEquals($ending, $schema->getEndingMap());
        $this->assertEquals($samples, $schema->getSamples());
    }

    public function testCreateFromNotExistsFile(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Schema::createFromFile('not.exists');
    }

    public function testCreateFromFileWhereFileIsDir(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Schema::createFromFile(__DIR__);
    }

    public function testCreateFromFileWithEmptyContent(): void
    {
        $this->expectException(\RuntimeException::class);

        Schema::createFromFile(__DIR__ . '/files/empty.php');
    }

    public function testCreateFromFileWhereContentIsNotArray(): void
    {
        $this->expectException(\RuntimeException::class);

        Schema::createFromFile(__DIR__ . '/files/date.php');
    }

    public function testCreateFromFile(): void
    {
        $data = include __DIR__ . '/files/content.php';

        $schema = Schema::createFromFile(__DIR__ . '/files/content.php');

        $this->assertEquals($data[0], $schema->getDefaultMap()->all());
        $this->assertEquals($data[1], $schema->getPrevMap()->all());
        $this->assertEquals($data[2], $schema->getNextMap()->all());
        $this->assertEquals($data[3], $schema->getEndingMap()->all());
        $this->assertEquals($data[4], $schema->getSamples());
    }
}
