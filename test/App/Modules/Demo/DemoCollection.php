<?php

declare(strict_types=1);

namespace GralhaoTest\App\Modules\Demo;

class DemoCollection extends \Gralhao\Collection
{
    public function __construct()
    {
        $this->setHandler(DemoController::class)
            ->setPrefix('/demo')
            ->post('/success', 'success')
            ->post('/error', 'error');
    }
}
