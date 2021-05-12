<?php

namespace Tleckie\Translate\Resolver;

use function explode;

/**
 * Class Locale
 *
 * @package  Tleckie\Translate\Resolver
 * @category Locale
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Locale
{
    /**
     * @var string
     */
    protected string $locale;

    /**
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale(string $locale): Locale
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $priority = [$this->locale];

        [$language,] = @explode('_', $this->locale);

        $priority[] = $language;

        return $priority;
    }
}
