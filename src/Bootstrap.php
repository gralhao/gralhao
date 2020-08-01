<?php

/**
 * @see       https://github.com/gralhao/gralhao
 * @copyright https://github.com/gralhao/gralhao/blob/master/COPYRIGHT.md
 * @license   https://github.com/gralhao/gralhao/blob/master/LICENSE.md
 */

declare(strict_types=1);

namespace Gralhao;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault as DependencyInjection;
use Phalcon\Config;
use Gralhao\Exception\GralhaoException;

final class Bootstrap
{
    /**
     * Phalcon Dependency Injection
     *
     * @var DependencyInjection
     */
    private DependencyInjection $di;

    /**
     * Phalcon MCV Micro
     *
     * @var Micro
     */
    private Micro $app;

    public function __construct(?string $path = '..')
    {
        $rootPath = realpath($path);
        $this->di = new DependencyInjection();
        $this->app = new Micro($this->di);
        $this->di->offsetSet('rootPath', function () use ($rootPath) {
            return $rootPath;
        });
    }

    /**
     * Load modules and start the application
     *
     * @return void
     */
    public function init(): void
    {
        try {
            $this->loadConfig()->loadModules();
            $this->app->handle($_SERVER['REQUEST_URI'] ?? '');
        } catch (\Throwable $th) {
            throw new GralhaoException($th->getMessage());
        }
    }

    /**
     * Returns an instance of Phalcon MVC Micro
     *
     * @return Micro
     */
    public function getApp(): Micro
    {
        return $this->app;
    }

    /**
     * Load modules from array property in application.config.php
     *
     * @return self
     */
    private function loadModules(): self
    {
        $modules = new \Gralhao\Loader\ModulesLoader($this->di);
        $modules->load($this->app);
        return $this;
    }

    /**
     * Load application.config.php array file
     *
     * @return self
     */
    private function loadConfig(): self
    {
        $configPath = $this->di->offsetGet('rootPath') . '/config/application.config.php';
        if (! file_exists($configPath) || ! is_readable($configPath)) {
            throw new GralhaoException('Config file does not exist: ' . $configPath);
        }
        $this->di->setShared('config', function () use ($configPath) {
            $data = require $configPath;
            return new Config($data);
        });
        return $this;
    }
}
