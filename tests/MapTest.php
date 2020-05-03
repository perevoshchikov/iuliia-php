<?php

namespace Anper\Iuliia\Tests\Schema;

use Anper\Iuliia\Map;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    public function testAll(): void
    {
        $data = ['foo' => 'bar'];
        $map = new Map($data);

        $this->assertEquals($data, $map->all());
    }

    public function testGet(): void
    {
        $data = ['foo' => 'bar'];
        $map = new Map($data);

        $this->assertEquals('bar', $map->get('foo'));
    }

    public function testGetNotExists(): void
    {
        $map = new Map([]);

        $this->assertEquals('', $map->get('foo'));
    }

    public function testGetDefault(): void
    {
        $map = new Map([]);

        $this->assertEquals('foo', $map->get('foo', 'foo'));
    }

    public function testGetDefaultNull(): void
    {
        $map = new Map([]);

        $this->assertNull($map->get('foo', null));
    }
}
