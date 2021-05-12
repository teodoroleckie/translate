<?php

namespace Tleckie\Translate\Tests\Resolver;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Tleckie\Translate\Resolver\File;

/**
 * Class FileTest
 *
 * @package  Tleckie\Translate\Tests\Resolver
 * @category FileTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class FileTest extends TestCase
{
    /**
     * @test
     * @dataProvider isFileDataProvider
     * @param        string $path
     * @param        string $locale
     * @param        string $extension
     * @param        bool   $expected
     */
    public function isFile(string $path, string $locale, string $extension, bool $expected): void
    {
        vfsStream::setup(
            'root',
            null,
            [
            'translations' => [
                'es_ES.php' => ""
            ]
            ]
        );

        $file = new File();

        static::assertEquals(sprintf("%s%s.%s", $path, $locale, $extension), $file->getFullPath($path, $locale, $extension));
        static::assertEquals($expected, $file->isFile($path, $locale, $extension));
    }

    /**
     * @return array[]
     */
    public function isFileDataProvider(): array
    {
        return [
            ['vfs://root/translations/', 'es_ES', 'php', true],
            ['vfs://root/translations/', 'es_EN', 'php', false],
            ['vfs://root/translations/', 'es_ES', 'xml', false],
            ['vfs://root/test/', 'es_ES', 'xml', false],
        ];
    }
}
