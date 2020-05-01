<?php

namespace Anper\Iuliia\Tests\Schema;

use Anper\Iuliia\Iuliia;
use PHPUnit\Framework\TestCase;

class SchemaTest extends TestCase
{
    public function testTranslate(): void
    {
        foreach (Iuliia::SCHEMAS as $schemaId => $file) {
            $engine = Iuliia::engine($schemaId);
            $definition = Iuliia::definition($schemaId);

            foreach ($definition->getSamples() as $sample) {
                $this->assertEquals(
                    $sample[1],
                    $engine->translate($sample[0]),
                    'Not equal strings for schema #' . $schemaId
                );
            }
        }
    }
}
