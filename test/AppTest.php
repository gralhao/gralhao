<?php

declare(strict_types=1);

namespace GralhaoTest;

use Gralhao\Exception\GralhaoException;

class AppTest extends TestCase
{

    public function testReturnAnApplicationInstance(): void
    {
        $this->bootstrap()->setRootPath(__DIR__);
        $this->assertInstanceOf(\Phalcon\Mvc\Micro::class, $this->getApp());
    }

    public function testReturnAnInvalidModuleException(): void
    {
        $this->expectException(GralhaoException::class);
        $bootstrap = $this->bootstrap();
        $bootstrap->setConfig([
            'modules' => [
                'GralhaoTest\InvalidModule'
            ]
        ]);
        $bootstrap->init();
    }

    public function testReturnAnInvalidConfigException(): void
    {
        $this->bootstrap()->setRootPath(__DIR__);
        $this->expectException(GralhaoException::class);
        $this->bootstrap()->setRootPath('invalid')->init();
        $bootstrap = $this->bootstrap();
        $bootstrap->setRootPath('invalid');
        $bootstrap->init();
    }

    public function testReturnAValidSuccessRequestResponse(): void
    {
        $this->bootstrap()->setRootPath(__DIR__);
        $request = new Request();
        $request->setMethod('POST')
            ->setPath('/test/success')
            ->setHeader('key', 'value')
            ->setBody('test');
        $response = $this->dispatch($request);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('test', $response->data->body);
        $this->assertEquals('value', $response->data->headers->key);
    }

    public function testReturnAValidErrorRequestResponse(): void
    {
        $this->bootstrap()->setRootPath(__DIR__);
        $request = new Request();
        $request->setMethod('POST')
            ->setPath('/test/error');
        $response = $this->dispatch($request);
        $this->assertEquals(400, $response->getStatusCode());
    }
}
