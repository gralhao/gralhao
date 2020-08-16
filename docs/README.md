# Gralhao Documentation
## About
This project uses [Phalcon](https://phalcon.io/), a hight performance php framework delivered as a C-extension.
The purpose here is create a development standard to design, test, and publish APIs fast than it could be. Of course is also important the idea about maintain and share code on different projects.

To make this possible, Gralhao uses [Phalcon Micro](https://docs.phalcon.io/4.0/en/application-micro), a very thin application combined with a moduled design structure.
Now is possible for example, design an authentication module, and use it like a dependency, in any project.

Everything made with Gralhao is opened to Phalcon. It means that all Phalcon features still available to be used.
See more in [Phalcon Documentation](https://docs.phalcon.io/4.0/en/introduction).

## Index
- [Bootstrapping](#bootstrapping)
- [Modules](#modules)
- [Collections](#collections)
- [Services](#services)
- [Models](#models)
- [Test](https://github.com/gralhao/gralhao-test)


### Bootstrapping <a name="bootstrapping"></a>

> If you need go fast, consider [Gralhao Egg](https://github.com/gralhao/gralhao-egg). It is an application skeleton, ready to code.

##### From array
```php
$bootstrap = new \Gralhao\Bootstrap();
$bootstrap->setConfig([
    'modules' => [
        'Module\Namespace'
    ]
])->init();
```
##### From file
This way will looks for an application.config.php file inside config folder.

``rootPath/config/application.config.php``
```php
<?php
return [
    'modules' => [
        'Module\Namespace'
    ]
];
```
```php
$bootstrap = new \Gralhao\Bootstrap();
$bootstrap->setRootPath(__DIR__)->init();
```

### Modules <a name="modules"></a>
In Gralhao, modules are just an alternative way to put your Phalcon code together.
Modules has a standard to load collections and services from only one entry point, the ``Module.php`` file.

##### Creating a module
Module classes need extends from ``Gralhao\Module``. And implements ``getConfig`` method, to return a module setup array.

```php
<?php

declare(strict_types=1);

namespace Flying;

use Flying\Collections\FlyingCollection;
use Flying\Services\FlyingService;

class Module extends \Gralhao\Module
{
    public function getconfig(): array
    {
        return [
            'collections' => [
                FlyingCollection::class,
            ],
            'services' => [
                'flyingService' => FlyingService::class,
            ]
        ];
    }
}
```
It's necessary to set in ``composer.json`` file, the module namespace on autoload.
```json
"autoload": {
    "psr-4": {
        "Flying\\": "src/Flying"
    }
}
```
Don't forget, run ``composer dump-autoload`` to update composer autoload.

##### Loading a module
Set the module namespace in ``application.config.php`` file.

```php
<?php

return [
    'modules' => [
        'Flying'
    ],
];
```
It also works to load a module from vendor dependency.

### Collections <a name="collections"></a>
Collections will makes possible to handle requests with a controller class.
You can see more about collection on [Phalcon Docs](https://docs.phalcon.io/3.4/en/api/phalcon_mvc_micro#class-phalconmvcmicrocollection).

In Gralhao, you need to create a collection class and call it in ``Module.php`` file.
The handler class (controller) needs to extends from ``\Gralhao\Controller``

##### Collection
```php
<?php

declare(strict_types=1);

namespace Flying;

class FlyingCollection extends \Gralhao\Collection
{
    public function __construct()
    {
        $this->setHandler(FlyingController::class)
            ->setPrefix('/flying')
            ->get('', 'success');
    }
}
```
##### Controller
```php
<?php

declare(strict_types=1);

namespace Flying;

class FlyingController extends \Gralhao\Controller
{
    public function success(): void
    {
        $this->send([
            'message' => 'Working fine..'
        ]);
    }
}
```
##### Module
```php
<?php

declare(strict_types=1);

namespace Flying;

class Module extends \Gralhao\Module
{
    public function getconfig(): array
    {
        return [
            'collections' => [
                FlyingCollection::class,
            ],
        ];
    }
}

```
### Services <a name="services"></a>
Services can be registred from a service class or a service provider.
To see more about, please check [Phalcon DI Documentation](https://docs.phalcon.io/4.0/pt-br/di).

Service classe:
```php
<?php

declare(strict_types=1);

namespace Flying\Services;

class FlyingService
{
    public function foo(): bool
    {
        return true;
    }
}

```

##### Registering from service class

```php
<?php

declare(strict_types=1);

namespace Flying;

use Flying\Collections\FlyingCollection;
use Flying\Services\FlyingService;

class Module extends \Gralhao\Module
{
    public function getconfig(): array
    {
        return [
            'collections' => [
                FlyingCollection::class,
            ],
            'services' => [
                'flyingService' => FlyingService::class,
                'flyingServiceUsingComplexRegistration' => [
                    'className'  => FlyingService::class,
                    'shared'     => true,
                    // 'arguments'  => [],
                    // 'calls'      => [],
                    // 'properties' => []
                ],
            ]
        ];
    }
}
```
See more about [Complex Registration](https://docs.phalcon.io/4.0/pt-br/di#complex-registration).

##### Registering from service provider
```php
<?php

declare(strict_types=1);

namespace Flying\Services;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class FlyingServiceProvider implements ServiceProviderInterface
{
    public function register(DiInterface $container): void
    {
        $container->set('flyingService', FlyingService::class);
    }
}

```

```php
<?php

declare(strict_types=1);

namespace Flying;

use Flying\Collections\FlyingCollection;
use Flying\Services\FlyingServiceProvider;

class Module extends \Gralhao\Module
{
    public function getconfig(): array
    {
        return [
            'collections' => [
                FlyingCollection::class,
            ],
            'service_provider' => [
                FlyingServiceProvider::class,
            ],
        ];
    }
}
```
##### Using Services
```php
echo $this->di->get('flyingService')->foo(); // True
```
