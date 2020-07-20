<?php

declare(strict_types=1);

namespace Gralhao\Test;

use PHPUnit\Framework\TestCase;
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
