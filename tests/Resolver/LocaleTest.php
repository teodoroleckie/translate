<?php

namespace Tleckie\Translate\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use Tleckie\Translate\Resolver\Locale;

/**
 * Class LocaleTest
 *
 * @package  Tleckie\Translate\Tests\Resolver
 * @category LocaleTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class LocaleTest extends TestCase
{
    /**
     * @test
     * @dataProvider localeDataProvider
     * @param        string $locale
     * @param        array  $expected
     */
    public function locale(string $locale, array $expected): void
    {
        $resolver = new Locale();

        $resolver->setLocale($locale);

        static::assertEquals($expected, $resolver->toArray());
    }

    /**
     * @return array[]
     */
    public function localeDataProvider(): array
    {
        return [
            ['es_ES', ['es_ES', 'es']],
            ['en_US', ['en_US', 'en']],
            ['en_GB', ['en_GB', 'en']],
        ];
    }
}
