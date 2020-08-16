<?php

declare(strict_types=1);

namespace GralhaoTest\App\Modules\Demo;

class DemoController extends \Gralhao\Controller
{
    public function success(): void
    {
        $this->send([
            'body'                => $this->request->getRawBody(),
            'headers'             => $this->request->getHeaders(),
            'method'              => $this->request->getMethod(),
            'fromService'         => $this->di->get('complexRegistredService')->data(),
            'fromServiceProvider' => $this->di->get('serviceRegistredFromProvider')->data(),
        ]);
    }

    public function error(): void
    {
        $this->sendError(['Invalid'], 400);
    }
}
