<?php

declare(strict_types=1);

namespace Gralhao;

abstract class Module
{
    /**
     * Module config
     *
     * @return array
     */
    abstract public function getConfig(): array;
}
