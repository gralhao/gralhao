<?php

declare(strict_types=1);

namespace Gralhao\Test\App\Modules\Foo\Controllers;

class BarController extends \Gralhao\Controller
{
    public function foo()
    {
        if (! $this->getDi()->request->getRawBody()) {
            return $this->sendError(['false'], 400);
        }
        $pluginData = $this->di->get('bar')->foo();
        return $this->send([$pluginData]);
    }
}
