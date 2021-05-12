<?php

namespace Tleckie\Translate\Bookmark;

use InvalidArgumentException;
use Tleckie\Translate\Catalogue\CatalogueInterface;
use Tleckie\Translate\Loader\LoaderInterface;

/**
 * Interface BookmarkInterface
 *
 * @package  Tleckie\Translate\Bookmark
 * @category BookmarkInterface
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface BookmarkInterface
{
    /**
     * @param  string $locale
     * @return bool
     */
    public function hasCatalogue(string $locale): bool;

    /**
     * @param LoaderInterface $loader
     *
     * @return BookmarkInterface
     */
    public function setLoader(LoaderInterface $loader): BookmarkInterface;

    /**
     * @param string $locale
     *
     * @return CatalogueInterface
     */
    public function getCatalogue(string $locale): CatalogueInterface;
}
