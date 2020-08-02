<?php

declare(strict_types=1);

namespace Gralhao\Test\App;

use PHPUnit\Framework\TestCase;
use Gralhao\Bootstrap;
use Phalcon\Http\Request;

class ErrorResponseTest extends TestCase
{
    public function testErrorResponse(): void
    {
        $bootstrap = new Bootstrap();
        $bootstrap->setConfig([
            'modules' => ['Gralhao\Test\App\Modules\Foo'],
        ]);
        $request = $this->createMock(Request::class);
        $request->method('getRawBody')->willReturn('');
        $app = $bootstrap->getApp();
        $app->getDi()->request = $request;
        $this->expectOutputString('{"error":["false"]}');
        $bootstrap->init();
    }
}
