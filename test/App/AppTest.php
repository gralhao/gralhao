<?php

declare(strict_types=1);

namespace Gralhao\Test\App;

use PHPUnit\Framework\TestCase;
use Gralhao\Bootstrap;

class AppTest extends TestCase
{
    public function testReturnAnAppInstance(): void
    {
        $bootstrap = new Bootstrap(__DIR__);
        $this->assertInstanceOf(\Phalcon\Mvc\Micro::class, $bootstrap->getApp());
    }
}
