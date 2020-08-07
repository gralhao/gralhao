<?php

declare(strict_types=1);

namespace GralhaoTest\Module;

class TestController extends \Gralhao\Controller
{
    public function success(): void
    {
        $this->send([
            'body'    => $this->request->getRawBody(),
            'headers' => $this->request->getHeaders(),
            'method'  => $this->request->getMethod(),
        ]);
    }

    public function error(): void
    {
        $this->sendError(['Invalid'], 400);
    }
}
