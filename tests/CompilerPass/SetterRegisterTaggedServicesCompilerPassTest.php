<?php

namespace Yokai\DependencyInjection\Tests\CompilerPass;

use Yokai\DependencyInjection\CompilerPass\SetterRegisterTaggedServicesCompilerPass;
use Yokai\DependencyInjection\Tests\Fixtures\ServiceInterface;

class SetterRegisterTaggedServicesCompilerPassTest extends RegisterTaggedServicesCompilerPassTestCase
{
    protected function createCompilerPass()
    {
        return new SetterRegisterTaggedServicesCompilerPass(
            'registry',
            'service',
            ServiceInterface::class,
            'setServices'
        );
    }
}
