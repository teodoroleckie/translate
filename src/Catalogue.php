<?php

declare(strict_types=1);

namespace Tleckie\Translate;

use ArrayIterator;
use Tleckie\Translate\Catalogue\CatalogueInterface;

/**
 * Class Catalogue
 *
 * @package  Tleckie\Translate
 * @category Catalogue
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Catalogue extends ArrayIterator implements CatalogueInterface
{
    /**
     * @inheritdoc
     */
    public function getByKey(string $key): mixed
    {
        return $this[$key] ?? null;
    }
}
