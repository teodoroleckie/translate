<?php

declare(strict_types=1);

namespace Tleckie\Translate;

use ArrayIterator;
use Tleckie\Translate\Bookmark\BookmarkInterface;
use Tleckie\Translate\Catalogue\CatalogueInterface;
use Tleckie\Translate\Loader\LoaderInterface;

/**
 * Class Bookmark
 *
 * @package  Tleckie\Translate
 * @category Bookmark
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Bookmark implements BookmarkInterface
{
    /**
     * @var ArrayIterator<CatalogueInterface>
     */
    protected ArrayIterator $catalogs;

    /**
     * @var LoaderInterface
     */
    protected LoaderInterface $loader;

    /**
     * Bookmark constructor.
     */
    public function __construct()
    {
        $this->catalogs = new ArrayIterator();
    }

    /**
     * @inheritdoc
     */
    public function setLoader(LoaderInterface $loader): BookmarkInterface
    {
        $this->loader = $loader;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCatalogue(string $locale): CatalogueInterface
    {
        if ($this->hasCatalogue($locale)) {
            return $this->catalogs[$locale];
        }

        return $this->catalogs[$locale] = new Catalogue($this->loader->load($locale));
    }

    /**
     * @inheritdoc
     */
    public function hasCatalogue(string $locale): bool
    {
        return isset($this->catalogs[$locale]);
    }
}
