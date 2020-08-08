<?php

declare(strict_types=1);

namespace GralhaoTest;

use Gralhao\Test\TestCase;
use Gralhao\Exception\GralhaoException;
use ArrayObject;

class CollectionTest extends TestCase
{
    public function testReturnExceptionWhenTrySetAnInvalidCollectionHandler(): void
    {
        $this->expectException(GralhaoException::class);
        $collection = new Collection();
        $collection->setHandler(ArrayObject::class);
    }
}
