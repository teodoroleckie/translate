<?php

declare(strict_types=1);

namespace Tleckie\Translate\Tests;

use ArrayIterator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tleckie\Translate\Bookmark;
use Tleckie\Translate\Bookmark\BookmarkInterface;
use Tleckie\Translate\Catalogue\CatalogueInterface;
use Tleckie\Translate\Loader\LoaderInterface;

/**
 * Class BookmarkTest
 *
 * @package  Tleckie\Translate\Tests
 * @category BookmarkTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class BookmarkTest extends TestCase
{
    /**
     * @var ArrayIterator|MockObject
     */
    protected ArrayIterator|MockObject $catalogsMock;

    /**
     * @var LoaderInterface|MockObject
     */
    protected LoaderInterface|MockObject $loaderMock;

    /**
     * @var BookmarkInterface
     */
    protected BookmarkInterface $bookmark;

    /**
     * @test
     */
    public function check(): void
    {
        static::assertInstanceOf(
            BookmarkInterface::class,
            $this->bookmark->setLoader($this->loaderMock)
        );

        static::assertFalse($this->bookmark->hasCatalogue('es_ES'));

        $this->loaderMock
            ->expects(static::once())
            ->method('load')
            ->willReturn(['test' => 'pruebas']);

        static::assertInstanceOf(
            CatalogueInterface::class,
            $this->bookmark->getCatalogue('es_ES')
        );

        $this->bookmark->getCatalogue('es_ES');
    }

    protected function setUp(): void
    {
        $this->catalogsMock = $this->createMock(ArrayIterator::class);

        $this->loaderMock = $this->createMock(LoaderInterface::class);

        $this->bookmark = new Bookmark();
    }
}
