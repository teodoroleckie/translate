<?php

declare(strict_types=1);

namespace Tleckie\Translate\Loader;

use InvalidArgumentException;
use Tleckie\Translate\Resolver\File;
use Tleckie\Translate\Resolver\Locale;

/**
 * Class ArrayLoader
 *
 * @package  Tleckie\Translate\Loader
 * @category ArrayLoader
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ArrayLoader implements LoaderInterface
{
    /**
     * @var string
     */
    protected string $path;

    /**
     * @var string
     */
    protected string $fileExtension;

    /**
     * @var File
     */
    protected File $fileResolver;

    /**
     * @var Locale
     */
    protected Locale $localeResolver;

    /**
     * ArrayLoader constructor.
     *
     * @param string      $path
     * @param string      $fileExtension
     * @param File|null   $fileResolver
     * @param Locale|null $localeResolver
     */
    public function __construct(
        string $path,
        string $fileExtension,
        File $fileResolver = null,
        Locale $localeResolver = null
    ) {
        $this->path = $path;
        $this->fileExtension = $fileExtension;
        $this->fileResolver = $fileResolver ?? new File();
        $this->localeResolver = $localeResolver ?? new Locale();
    }

    /**
     * @inheritdoc
     */
    public function load(string $locale): array
    {
        $this->localeResolver->setLocale($locale);

        foreach ($this->localeResolver->toArray() as $part) {
            if ($this->fileResolver->isFile($this->path, $part, $this->fileExtension)) {
                return include $this->fileResolver->getFullPath(
                    $this->path,
                    $part,
                    $this->fileExtension
                );
            }
        }

        throw new InvalidArgumentException(
            sprintf('Locale [%s] not found in [%s]', $locale, $this->path)
        );
    }
}
