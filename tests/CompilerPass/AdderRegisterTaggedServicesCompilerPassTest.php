<?php

namespace Yokai\DependencyInjection\Tests\CompilerPass;

use Yokai\DependencyInjection\CompilerPass\AdderRegisterTaggedServicesCompilerPass;
use Yokai\DependencyInjection\Tests\Fixtures\ServiceInterface;

class AdderRegisterTaggedServicesCompilerPassTest extends RegisterTaggedServicesCompilerPassTestCase
{
    protected function createCompilerPass()
    {
        return new AdderRegisterTaggedServicesCompilerPass(
            'registry',
            'service',
            ServiceInterface::class,
            'addService'
        );
    }
}
