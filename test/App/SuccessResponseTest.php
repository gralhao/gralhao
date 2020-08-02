<?php

declare(strict_types=1);

namespace Gralhao\Test\App;

use PHPUnit\Framework\TestCase;
use Gralhao\Bootstrap;
use Phalcon\Http\Request;

class SuccessResponseTest extends TestCase
{
    public function testSuccessResponse(): void
    {
        $bootstrap = new Bootstrap();
        $bootstrap->setRootPath(__DIR__);
        $request = $this->createMock(Request::class);
        $request->method('getRawBody')->willReturn('data');
        $app = $bootstrap->getApp();
        $app->getDi()->request = $request;
        $this->expectOutputString('["bar"]');
        $bootstrap->init();
    }
}
