<?php

namespace Tleckie\Translate;

use Tleckie\Translate\Bookmark\BookmarkInterface;
use Tleckie\Translate\Loader\LoaderInterface;
use function sprintf;

/**
 * Class Translator
 *
 * @package  Tleckie\Translate
 * @category Translator
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Translator implements TranslatorInterface
{
    /**
     * @var LoaderInterface
     */
    protected LoaderInterface $loader;

    /**
     * @var string
     */
    protected string $locale;

    /**
     * @var BookmarkInterface
     */
    protected BookmarkInterface $bookmark;

    /**
     * Translator constructor.
     *
     * @param LoaderInterface        $loader
     * @param string                 $locale
     * @param BookmarkInterface|null $bookmark
     */
    public function __construct(
        LoaderInterface $loader,
        string $locale = '',
        BookmarkInterface $bookmark = null
    ) {
        $this->loader = $loader;

        $this->setLocale($locale);

        $this->bookmark = $bookmark ?? new Bookmark();

        $this->bookmark->setLoader($loader);
    }

    /**
     * @inheritdoc
     */
    public function getBookmark(): BookmarkInterface
    {
        return $this->bookmark;
    }

    /**
     * @inheritdoc
     */
    public function getLoader(): LoaderInterface
    {
        return $this->loader;
    }

    /**
     * @inheritdoc
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @inheritdoc
     */
    public function setLocale(string $locale): TranslatorInterface
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function trans(
        string $keyToTranslate,
        array $arguments = [],
        string $fallback = null,
        string $locale = null
    ): string {
        $locale = $locale ?? $this->locale;

        $translated = $this->bookmark->getCatalogue($locale)->getByKey($keyToTranslate);

        $replaced = sprintf($translated, ...$arguments);

        if (empty($replaced)) {
            return $fallback;
        }

        return $replaced;
    }
}
