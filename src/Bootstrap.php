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

    /**
     * Config array
     *
     * @var array
     */
    private array $config = [];

    /**
     * Project Root Path
     *
     * @var string
     */
    private string $rootPath = '..';

    public function __construct()
    {
        $this->di = new DependencyInjection();
        $this->app = new Micro($this->di);
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
     * Set application config data
     *
     * @param array $config
     * 
     * @return self
     */
    public function setConfig(array $config): self
    {
        $this->config = $config;
        return $this;
    }

    /**
     * Set application root path
     *
     * @param string $rootPath
     * 
     * @return self
     */
    public function setRootPath(string $rootPath): self
    {
        $this->rootPath = $rootPath;
        return $this;
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
        if (! $this->config) {
            $configPath = realpath($this->rootPath) . '/config/application.config.php';
            if (! file_exists($configPath) || ! is_readable($configPath)) {
                throw new GralhaoException('Config file does not exist: ' . $configPath);
            }
            $this->config = require $configPath;
        }
        $config = $this->config;
        $this->di->setShared('config', function () use ($config) {
            return new Config($config);
        });
        return $this;
    }
}
