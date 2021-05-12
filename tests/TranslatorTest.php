<?php

namespace Tleckie\Translate\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tleckie\Translate\Bookmark\BookmarkInterface;
use Tleckie\Translate\Catalogue\CatalogueInterface;
use Tleckie\Translate\Loader\LoaderInterface;
use Tleckie\Translate\Translator;
use Tleckie\Translate\TranslatorInterface;

/**
 * Class TranslatorTest
 *
 * @package  Tleckie\Translate\Tests
 * @category TranslatorTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class TranslatorTest extends TestCase
{
    /**
     * @var LoaderInterface|MockObject
     */
    protected LoaderInterface|MockObject $loaderMock;

    /**
     * @var BookmarkInterface|MockObject
     */
    protected BookmarkInterface|MockObject $bookmarkMock;

    /**
     * @var TranslatorInterface
     */
    protected TranslatorInterface $translator;

    /**
     * @test
     */
    public function getBookmark(): void
    {
        static::assertEquals($this->bookmarkMock, $this->translator->getBookmark());
    }

    /**
     * @test
     */
    public function getLocale(): void
    {
        static::assertEquals('es_ES', $this->translator->getLocale());
    }

    /**
     * @test
     */
    public function getLoader(): void
    {
        static::assertEquals($this->loaderMock, $this->translator->getLoader());
    }

    /**
     * @test
     */
    public function transWithValue(): void
    {
        $catalogueMock = $this->createMock(CatalogueInterface::class);

        $this->bookmarkMock
            ->method('getCatalogue')
            ->withConsecutive(
                ['es_ES'],
                ['es_ES'],
                ['es_ES'],
                ['en_GB']
            )
            ->willReturnOnConsecutiveCalls(
                $catalogueMock,
                $catalogueMock,
                $catalogueMock,
                $catalogueMock
            );

        $catalogueMock
            ->method('getByKey')
            ->withConsecutive(
                ['key1'],
                ['key2'],
                ['key3'],
                ['key4']
            )
            ->willReturnOnConsecutiveCalls(
                'value',
                'value [%s]',
                null,
                'Hi!'
            );

        static::assertEquals('value', $this->translator->trans('key1'));
        static::assertEquals('value [6]', $this->translator->trans('key2', [6]));
        static::assertEquals('fallback', $this->translator->trans('key3', [], 'fallback'));
        static::assertEquals('Hi!', $this->translator->trans('key4', [], '', 'en_GB'));
    }

    protected function setUp(): void
    {
        $this->loaderMock = $this->createMock(LoaderInterface::class);

        $this->bookmarkMock = $this->createMock(BookmarkInterface::class);

        $this->bookmarkMock
            ->expects(static::once())
            ->method('setLoader')
            ->with($this->loaderMock);

        $this->translator = new Translator(
            $this->loaderMock,
            'es_ES',
            $this->bookmarkMock
        );
    }
}
