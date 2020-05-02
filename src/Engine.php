<?php

namespace Anper\Iuliia;

/**
 * Class Engine
 * @package Anper\Iuliia
 */
class Engine
{
    protected const WORD_CHARS = 'АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя';

    /**
     * @var Schema
     */
    protected $schema;

    /**
     * @param Schema $schema
     */
    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }

    /**
     * @return Schema
     */
    public function getSchema(): Schema
    {
        return $this->schema;
    }

    /**
     * @param string $str
     *
     * @return string
     */
    public function translate(string $str): string
    {
        $words = $this->strToWords($str);
        $words = \array_flip($words);

        foreach ($words as $word => $tmp) {
            $words[$word] = $this->translateWord($word);
        }

        return \strtr($str, $words);
    }

    /**
     * @param string $str
     *
     * @return array
     */
    protected function strToWords(string $str): array
    {
        return \array_unique(\str_word_count($str, 1, static::WORD_CHARS));
    }

    /**
     * @param string $word
     *
     * @return string
     */
    protected function translateWord(string $word): string
    {
        $translated = '';

        $word = $this->translateEnding($word);

        foreach ($this->read($word) as [$prev, $curr, $next]) {
            $letter = $this->schema
                ->getPrevMap()
                ->get($prev . $curr, null);

            if ($letter === null) {
                $letter = $this->schema
                    ->getNextMap()
                    ->get($curr . $next, null);
            }

            if ($letter === null) {
                $letter = $this->schema
                    ->getDefaultMap()
                    ->get($curr, $curr);
            }

            $translated .= $letter;
        }

        return $translated;
    }

    /**
     * @param string $word
     * @param int $length
     *
     * @return string
     */
    protected function translateEnding(string $word, int $length = 2): string
    {
        if (\mb_strlen($word) < $length) {
            return $word;
        }

        $offset = -1 * $length;
        $ending = \mb_substr($word, $offset);

        return \mb_substr($word, 0, $offset)
            . $this->schema->getEndingMap()->get($ending, $ending);
    }

    /**
     * @param string $word
     *
     * @return \Generator
     */
    protected function read(string $word): \Generator
    {
        $str = \preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);

        for ($i = 0, $max = \count($str); $i < $max; $i++) {
            yield [
                $str[$i - 1] ?? '',
                $str[$i],
                $str[$i + 1] ?? '',
            ];
        }
    }
}
