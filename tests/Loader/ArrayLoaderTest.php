<?php

namespace Tleckie\Translate\Tests\Loader;

use InvalidArgumentException;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tleckie\Translate\Loader\ArrayLoader;
use Tleckie\Translate\Resolver\File;
use Tleckie\Translate\Resolver\Locale;

/**
 * Class ArrayLoaderTest
 *
 * @package  Tleckie\Translate\Tests\Loader
 * @category ArrayLoaderTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ArrayLoaderTest extends TestCase
{
    /**
     * @var File|MockObject
     */
    protected File|MockObject $fileResolverMock;

    /**
     * @var Locale|MockObject
     */
    protected Locale|MockObject $localeResolverMock;

    /**
     * @var ArrayLoader
     */
    protected ArrayLoader $loader;

    /**
     * @var vfsStreamDirectory
     */
    protected vfsStreamDirectory $root;

    /**
     * @test
     */
    public function load(): void
    {
        $this->localeResolverMock
            ->expects(static::once())
            ->method('setLocale');

        $this->localeResolverMock
            ->expects(static::once())
            ->method('toArray')
            ->willReturn(['es_ES', 'es']);

        $this->fileResolverMock
            ->method('isFile')
            ->withConsecutive(
                [$this->root->url() . '/translations/', 'es_ES', 'php'],
                [$this->root->url() . '/translations/', 'es', 'php']
            )
            ->willReturnOnConsecutiveCalls(false, true);

        $this->fileResolverMock
            ->expects(static::once())
            ->method('getFullPath')
            ->with($this->root->url() . '/translations/', 'es', 'php')
            ->willReturn($this->root->url() . '/translations/es.php');

        static::assertEquals([1, 2, 3], $this->loader->load('es_ES'));
    }

    /**
     * @test
     */
    public function loadThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Locale [es_CA] not found in [%s]', $this->root->url() . '/translations/')
        );

        $this->localeResolverMock
            ->expects(static::once())
            ->method('setLocale');

        $this->localeResolverMock
            ->expects(static::once())
            ->method('toArray')
            ->willReturn(['es_CA', 'es']);

        $this->fileResolverMock
            ->method('isFile')
            ->withConsecutive(
                [$this->root->url() . '/translations/', 'es_CA', 'php'],
                [$this->root->url() . '/translations/', 'es', 'php']
            )
            ->willReturnOnConsecutiveCalls(false, false);

        $this->loader->load('es_CA');
    }

    protected function setUp(): void
    {
        $this->root = vfsStream::setup(
            'root',
            null,
            [
            'translations' => [
                'es.php' => "<?php return [1,2,3];"
            ]
            ]
        );

        $this->fileResolverMock = $this->createMock(File::class);

        $this->localeResolverMock = $this->createMock(Locale::class);

        $this->loader = new ArrayLoader(
            $this->root->url() . '/translations/',
            'php',
            $this->fileResolverMock,
            $this->localeResolverMock
        );
    }
}
