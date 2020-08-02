<?php

/**
 * @see       https://github.com/gralhao/gralhao
 * @copyright https://github.com/gralhao/gralhao/blob/master/COPYRIGHT.md
 * @license   https://github.com/gralhao/gralhao/blob/master/LICENSE.md
 */

declare(strict_types=1);

namespace Gralhao;

use Phalcon\Mvc\Controller as PhalconController;

abstract class Controller extends PhalconController
{
    /**
     * Dispatch HTTP Response
     *
     * @param array $content
     * @param int|null $statusCode
     * @param string|null $statusMessage
     * @return void
     */
    protected function send(array $content, ?int $statusCode = 200, ?string $statusMessage = null): void
    {
        $this->response->setStatusCode($statusCode, $statusMessage);
        if ($content) {
            $this->response->setJsonContent($content);
        }
        $this->response->send();
    }

    /**
     * Dispatch HTTP Response with formated error
     *
     * @param array $error
     * @param int $statusCode
     * @return void
     */
    protected function sendError(array $error, int $statusCode): void
    {
        $this->send([
            'error' => $error
        ], $statusCode);
    }
}
