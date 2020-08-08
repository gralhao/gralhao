# Gralhao Documentation
## About
This project uses [Phalcon](https://phalcon.io/), a hight performance php framework delivered as a C-extension.
The purpose here is create a development standard to design, test, and publish APIs fast than it could be. Of course is also important the idea about maintain and share code on different projects.

To make this possible, Gralhao uses [Phalcon Micro](https://docs.phalcon.io/4.0/en/application-micro), a very thin application combined with a moduled design structure.
Now is possible for example, design an authentication module, and use it like a dependency, in any project.

Everything made with Gralhao is opened to Phalcon. It means that all Phalcon features still available to be used.
See more in [Phalcon Documentation](https://docs.phalcon.io/4.0/en/introduction).

## Index
- [Bootstraping](#bootstraping)
- [Modules](#modules)
- [Collections](#collections)
- [Providers](#providers)
- [Models](#models)


### Bootstraping <a name = "bootstraping"></a>

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
