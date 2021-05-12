<?php

namespace Tleckie\Translate\Resolver;

use function is_file;
use function sprintf;

/**
 * Class File
 *
 * @package  Tleckie\Translate\Resolver
 * @category File
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class File
{
    /**
     * @param  string $path
     * @param  string $locale
     * @param  string $extension
     * @return bool
     */
    public function isFile(string $path, string $locale, string $extension): bool
    {
        return is_file($this->getFullPath($path, $locale, $extension));
    }

    /**
     * @param  string $path
     * @param  string $locale
     * @param  string $extension
     * @return string
     */
    public function getFullPath(string $path, string $locale, string $extension): string
    {
        return sprintf("%s%s.%s", $path, $locale, $extension);
    }
}
