<?php

declare(strict_types=1);

namespace Tleckie\Translate\Catalogue;

/**
 * Interface CatalogueInterface
 *
 * @package  Tleckie\Translate\Catalogue
 * @category CatalogueInterface
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface CatalogueInterface
{
    /**
     * @param string $key
     *
     * @return string|null
     */
    public function getByKey(string $key): mixed;
}
