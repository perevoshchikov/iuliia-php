# `Iuliia`

[![Software License][ico-license]](LICENSE.md)
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Build Status][ico-ga]][link-ga]


> Transliterate Cyrillic → Latin in every possible way

> This is the port of the incredible js library [iuliia](https://github.com/nalgeon/iuliia-js).

## Why use `Iuliia`
- [20 transliteration schemas](https://github.com/nalgeon/iuliia) (rule sets), including all main international and Russian standards.
- Correctly implements not only the base mapping, but all the special rules for letter combinations and word endings (AFAIK, Iuliia is the only library which does so).
- Simple API and zero third-party dependencies.

## Install

``` bash
$ composer require anper/iuliia
```

## Usage

``` php
use Anper\Iuliia\Iuliia;

echo Iuliia::translate('Юлия Щеглова', Iuliia::ICAO_DOC_9303);
// Iuliia Shcheglova

echo Iuliia::translate('Юлия Щеглова', Iuliia::WIKIPEDIA);
// Yuliya Shcheglova
```

## Test

``` bash
$ composer test
```

## Development

`schemas` folder is the git submodule from [general repository](https://github.com/nalgeon/iuliia). You can add schemes manually and use building to generate code:

``` bash
$ composer build
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/anper/iuliia.svg
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[ico-ga]: https://github.com/perevoshchikov/iuliia-php/workflows/Tests/badge.svg

[link-packagist]: https://packagist.org/packages/anper/iuliia
[link-ga]: https://github.com/perevoshchikov/iuliia-php/actions
