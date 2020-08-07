<?php

declare(strict_types=1);

namespace GralhaoTest\Module;

class Module extends \Gralhao\Module
{
    public function getconfig(): array
    {
        return [
            'collections' => [
                TestCollection::class,
            ],
            'providers' => [
                'providerTest' => ProviderTest::class,
            ]
        ];
    }
}
