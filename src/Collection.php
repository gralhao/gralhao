<?php

/**
 * @see       https://github.com/gralhao/gralhao
 * @copyright https://github.com/gralhao/gralhao/blob/master/COPYRIGHT.md
 * @license   https://github.com/gralhao/gralhao/blob/master/LICENSE.md
 */

declare(strict_types=1);

namespace Gralhao;

use Phalcon\Mvc\Micro\Collection as PhalconCollection;
use Phalcon\Mvc\Micro\CollectionInterface;
use Gralhao\Exception\GralhaoException;

abstract class Collection extends PhalconCollection
{
    /**
     * @inheritDoc
     */
    public function setHandler($handler, bool $lazy = true): CollectionInterface
    {
        if (! is_subclass_of($handler, Controller::class)) {
            throw new GralhaoException($handler . ' needs extends Gralhao\Controller');
        }
        return parent::setHandler($handler, $lazy);
    }
}
