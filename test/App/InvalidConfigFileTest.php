<?php

declare(strict_types=1);

namespace Gralhao\Test\App;

use PHPUnit\Framework\TestCase;
use Gralhao\Bootstrap;
use Gralhao\Exception\GralhaoException;

class InvalidConfigFileTest extends TestCase
{
    public function testReturnGralhaoExceptionWhenTryUseInvalidConfigFile(): void
    {
        $this->expectException(GralhaoException::class);
        $bootstrap = new Bootstrap(__DIR__ . '/fake/');
        $bootstrap->init();
    }
}
