# Dependency Injection

## Installation

``` bash
$ php composer.phar require yokai/dependency-injection
```

## Compiler Pass

``` php
<?php

namespace AppBundle;

use Yokai\DependencyInjection\CompilerPass\ArgumentRegisterTaggedServicesCompilerPass;
use Yokai\DependencyInjection\CompilerPass\AdderRegisterTaggedServicesCompilerPass;
use Yokai\DependencyInjection\CompilerPass\SetterRegisterTaggedServicesCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container
            ->addCompilerPass(
                new ArgumentRegisterTaggedServicesCompilerPass(
                    'some_service_id',
                    'some_tag_name',
                    'An\Optional\Interface\To\Check',
                    0
                )
            )
            ->addCompilerPass(
                new AdderRegisterTaggedServicesCompilerPass(
                    'some_service_id',
                    'some_tag_name',
                    'An\Optional\Interface\To\Check',
                    'addDependency'
                )
            )
            ->addCompilerPass(
                new SetterRegisterTaggedServicesCompilerPass(
                    'some_service_id',
                    'some_tag_name',
                    'An\Optional\Interface\To\Check',
                    'setDependencies'
                )
            )
        ;
    }
}
```

### ArgumentRegisterTaggedServicesCompilerPass

This compiler pass will :

- check for the service (first argument) existence (throw `LogicException` if not)
- find services tagged with tag (second argument)
- if provided, check every service against an interface (third argument) (throw `LogicException` if not)
- sort these references base on a `priority` attribute
- replace an argument (fourth argument) of your service definition with the sorted references


## AdderRegisterTaggedServicesCompilerPass

This compiler pass will :

- check for the service (first argument) existence (throw `LogicException` if not)
- find services tagged with tag (second argument)
- if provided, check every service against an interface (third argument) (throw `LogicException` if not)
- sort these references base on a `priority` attribute
- call a method (fourth argument) for each sorted references


## SetterRegisterTaggedServicesCompilerPass

This compiler pass will :

- check for the service (first argument) existence (throw `LogicException` if not)
- find services tagged with tag (second argument)
- if provided, check every service against an interface (third argument) (throw `LogicException` if not)
- sort these references base on a `priority` attribute
- call a method (fourth argument) with all sorted references


MIT License
-----------

License can be found [here](https://github.com/yann-eugone/dependency-injection/blob/master/LICENSE).


Authors
-------

The bundle was originally created by [Yann Eugoné](https://github.com/yann-eugone).
See the list of [contributors](https://github.com/yann-eugone/dependency-injection/contributors).
