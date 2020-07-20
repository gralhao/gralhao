<?php

declare(strict_types=1);

namespace Gralhao\Test\App\Modules\Foo;

use Gralhao\Test\App\Modules\Foo\Collections\BarCollection;
use Gralhao\Test\App\Modules\Foo\Plugins\BarPlugin;

class Module extends \Gralhao\Module
{
    public function getConfig(): array
    {
        return [
            'collections' => [
                BarCollection::class,
            ],
            'providers' => [
                'bar' => BarPlugin::class
            ]
        ];
    }
}