<?php

declare(strict_types=1);

namespace Tleckie\Translate\Tests;

use PHPUnit\Framework\TestCase;
use Tleckie\Translate\Catalogue;

/**
 * Class CatalogueTest
 *
 * @package  Tleckie\Translate\Tests
 * @category CatalogueTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class CatalogueTest extends TestCase
{
    /**
     * @test
     */
    public function getByKey(): void
    {
        $catalogue = new Catalogue(['test' => 1, 'value' => false]);

        static::assertEquals(1, $catalogue->getByKey('test'));

        static::assertEquals(false, $catalogue->getByKey('value'));

        static::assertEquals(null, $catalogue->getByKey('notFound'));
    }
}
