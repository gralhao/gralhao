<?php

/**
 * @see       https://github.com/gralhao/gralhao
 * @copyright https://github.com/gralhao/gralhao/blob/master/COPYRIGHT.md
 * @license   https://github.com/gralhao/gralhao/blob/master/LICENSE.md
 */

declare(strict_types=1);

namespace Gralhao\Loader;

use Gralhao\Exception\GralhaoException;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\Micro;

final class ModulesLoader extends Injectable
{

    /**
     * Load modules dependencies
     * @param Micro $app
     *
     * @return void
     */
    public function load(Micro $app): void
    {
        foreach ($this->getModulesConfig() as $configs) {
            foreach ($configs as $type => $classes) {
                foreach ($classes as $key => $classeNameSpace) {
                    switch ($type) {
                        case 'collections':
                            $app->mount(new $classeNameSpace());
                            break;
                        case 'providers':
                            $this->di->set($key, $classeNameSpace);
                            break;
                    }
                }
            }
        }
    }

    /**
     * Get the modules config list
     *
     * @return array
     */
    private function getModulesConfig(): array
    {
        $configs = [];
        foreach ($this->config->modules->toArray() as $moduleNameSpace) {
            $moduleNameSpace = $moduleNameSpace . '\\Module';
            $module = new $moduleNameSpace();
            if (! $module instanceof \Gralhao\Module) {
                throw new GralhaoException($moduleNameSpace . ' needs extends \Gralhao\Module', 1);
            }
            $configs[$moduleNameSpace] = $module->getConfig();
        }
        return $configs;
    }
}
