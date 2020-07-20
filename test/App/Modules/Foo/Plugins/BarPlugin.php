<?php

declare(strict_types=1);

namespace Gralhao\Test\App\Modules\Foo\Plugins;

use Phalcon\Di\Injectable;

class BarPlugin extends Injectable
{
    public function foo(): string
    {
        return 'bar';
    }
}
