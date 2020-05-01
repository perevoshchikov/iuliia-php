<?php

namespace Anper\Iuliia;

/**
 * Class Iuliia
 * @package Anper\Iuliia
 */
class Iuliia
{
    public const ALA_LC         = 1;
    public const ALA_LC_ALT     = 2;
    public const BGN_PCGN       = 3;
    public const BGN_PCGN_ALT   = 4;
    public const BS_2979        = 5;
    public const BS_2979_ALT    = 6;
    public const GOST_16876     = 7;
    public const GOST_16876_ALT = 8;
    public const GOST_52290     = 9;
    public const GOST_52535     = 10;
    public const GOST_7034      = 11;
    public const GOST_779       = 12;
    public const GOST_779_ALT   = 13;
    public const ICAO_DOC_9303  = 14;
    public const ISO_9_1954     = 15;
    public const ISO_9_1968     = 16;
    public const ISO_9_1968_ALT = 17;
    public const MOSMETRO       = 18;
    public const MVD_310        = 19;
    public const MVD_310_FR     = 20;
    public const MVD_782        = 21;
    public const SCIENTIFIC     = 22;
    public const TELEGRAM       = 23;
    public const UNGEGN_1987    = 24;
    public const WIKIPEDIA      = 25;
    public const YANDEX_MAPS    = 26;
    public const YANDEX_MONEY   = 27;

    public const SCHEMAS = [
        self::ALA_LC         => 'ala_lc',
        self::ALA_LC_ALT     => 'ala_lc_alt',
        self::BGN_PCGN       => 'bgn_pcgn',
        self::BGN_PCGN_ALT   => 'bgn_pcgn_alt',
        self::BS_2979        => 'bs_2979',
        self::BS_2979_ALT    => 'bs_2979_alt',
        self::GOST_16876     => 'gost_16876',
        self::GOST_16876_ALT => 'gost_16876_alt',
        self::GOST_52290     => 'gost_52290',
        self::GOST_52535     => 'gost_52535',
        self::GOST_7034      => 'gost_7034',
        self::GOST_779       => 'gost_779',
        self::GOST_779_ALT   => 'gost_779_alt',
        self::ICAO_DOC_9303  => 'icao_doc_9303',
        self::ISO_9_1954     => 'iso_9_1954',
        self::ISO_9_1968     => 'iso_9_1968',
        self::ISO_9_1968_ALT => 'iso_9_1968_alt',
        self::MOSMETRO       => 'mosmetro',
        self::MVD_310        => 'mvd_310',
        self::MVD_310_FR     => 'mvd_310_fr',
        self::MVD_782        => 'mvd_782',
        self::SCIENTIFIC     => 'scientific',
        self::TELEGRAM       => 'telegram',
        self::UNGEGN_1987    => 'ungegn_1987',
        self::WIKIPEDIA      => 'wikipedia',
        self::YANDEX_MAPS    => 'yandex_maps',
        self::YANDEX_MONEY   => 'yandex_money',
    ];

    /**
     * @param string $str
     * @param int $schema
     *
     * @return string
     */
    public static function translate(string $str, int $schema): string
    {
        return static::engine($schema)->translate($str);
    }

    /**
     * @param int $schema
     *
     * @return Engine
     */
    public static function engine(int $schema): Engine
    {
        return new Engine(static::schema($schema));
    }

    /**
     * @param int $schema
     *
     * @return Schema
     */
    public static function schema(int $schema): Schema
    {
        $filepath = static::resolveFilePath($schema, 'build', '.php');

        return Schema::createFromFile($filepath);
    }

    /**
     * @param int $schema
     * @param string $dir
     * @param string $ext
     *
     * @return string
     */
    protected static function resolveFilePath(int $schema, string $dir, string $ext): string
    {
        $filename = static::SCHEMAS[$schema] ?? null;

        if ($filename === null) {
            throw new \InvalidArgumentException("Schema #$schema not found");
        }

        return __DIR__
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
            . $dir
            . DIRECTORY_SEPARATOR
            . $filename
            . $ext;
    }
}
