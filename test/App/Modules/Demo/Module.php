<?php

declare(strict_types=1);

namespace GralhaoTest\App\Modules\Demo;

class Module extends \Gralhao\Module
{
    public function getconfig(): array
    {
        return [
            'collections' => [
                DemoCollection::class,
            ],
            'providers' => [
                'demoProvider' => DemoProvider::class,
            ]
        ];
    }
}
