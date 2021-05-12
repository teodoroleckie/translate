<?php

namespace Tleckie\Translate\Loader;

use InvalidArgumentException;

/**
 * Interface LoaderInterface
 *
 * @package  Tleckie\Translate\Loader
 * @category LoaderInterface
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface LoaderInterface
{
    /**
     * @param string $locale
     *
     * @return array
     *
     * @throws InvalidArgumentException
     */
    public function load(string $locale): array;
}
