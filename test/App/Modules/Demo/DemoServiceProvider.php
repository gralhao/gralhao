<?php

declare(strict_types=1);

namespace GralhaoTest\App\Modules\Demo;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class DemoServiceProvider implements ServiceProviderInterface
{
    public function register(DiInterface $container): void
    {
        $container->set('serviceRegistredFromProvider', DemoService::class);
    }
}
