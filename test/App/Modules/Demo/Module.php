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
            'services' => [
                'simpleRegistredService'  => DemoService::class,
                'complexRegistredService' => [
                    'className'  => DemoService::class,
                    'shared'     => true,
                    'arguments'  => [],
                    'calls'      => [],
                    'properties' => []
                ],
            ],
            'service_providers' => [
                DemoServiceProvider::class
            ]
        ];
    }
}
