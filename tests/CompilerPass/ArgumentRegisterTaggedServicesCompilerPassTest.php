<?php

namespace Yokai\DependencyInjection\Tests\CompilerPass;

use Yokai\DependencyInjection\CompilerPass\ArgumentRegisterTaggedServicesCompilerPass;
use Yokai\DependencyInjection\Tests\Fixtures\ServiceInterface;

class ArgumentRegisterTaggedServicesCompilerPassTest extends RegisterTaggedServicesCompilerPassTestCase
{
    protected function createCompilerPass()
    {
        return new ArgumentRegisterTaggedServicesCompilerPass(
            'registry',
            'service',
            ServiceInterface::class,
            0
        );
    }
}
