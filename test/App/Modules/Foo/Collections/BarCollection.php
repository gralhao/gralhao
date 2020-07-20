<?php

declare(strict_types=1);

namespace Gralhao\Test\App\Modules\Foo\Collections;

use Gralhao\Test\App\Modules\Foo\Controllers\BarController;

class BarCollection extends \Gralhao\Collection
{
    public function __construct()
    {
        $this->setHandler(BarController::class)->get('/', 'foo');
    }
}
