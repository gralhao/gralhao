<?php

declare(strict_types=1);

namespace GralhaoTest\Module;

class TestCollection extends \Gralhao\Collection
{
    public function __construct()
    {
        $this->setHandler(TestController::class)
            ->setPrefix('/test')
            ->post('/success', 'success')
            ->post('/error', 'error');
    }
}
