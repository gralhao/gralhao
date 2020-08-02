<?php

declare(strict_types=1);

namespace Gralhao\Test\InvalidApp;

use PHPUnit\Framework\TestCase;
use Gralhao\Bootstrap;
use Gralhao\Exception\GralhaoException;

class InvalidAppTest extends TestCase
{
    public function testReturnInvalidModuleException(): void
    {
        $this->expectException(GralhaoException::class);
        $bootstrap = new Bootstrap();
        $bootstrap->setRootPath(__DIR__);
        $bootstrap->init();
    }
}
