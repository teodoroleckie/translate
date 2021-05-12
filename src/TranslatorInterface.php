<?php

namespace Tleckie\Translate;

use Tleckie\Translate\Bookmark\BookmarkInterface;
use Tleckie\Translate\Loader\LoaderInterface;

/**
 * Interface TranslatorInterface
 *
 * @package  Tleckie\Translate
 * @category TranslatorInterface
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface TranslatorInterface
{
    /**
     * @param string $locale
     *
     * @return TranslatorInterface
     */
    public function setLocale(string $locale): TranslatorInterface;

    /**
     * @return string
     */
    public function getLocale(): string;

    /**
     * @return BookmarkInterface
     */
    public function getBookmark(): BookmarkInterface;

    /**
     * @return LoaderInterface
     */
    public function getLoader(): LoaderInterface;

    /**
     * @param string      $keyToTranslate
     * @param array       $arguments
     * @param string|null $fallback
     * @param string|null $locale
     *
     * @return string
     */
    public function trans(
        string $keyToTranslate,
        array $arguments = [],
        string $fallback = null,
        string $locale = null
    ): string;
}
