<?php

namespace Yokai\DependencyInjection\Tests\CompilerPass;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Yokai\DependencyInjection\Tests\Fixtures\Service1;
use Yokai\DependencyInjection\Tests\Fixtures\Service2;
use Yokai\DependencyInjection\Tests\Fixtures\Service3;
use Yokai\DependencyInjection\Tests\Fixtures\ServiceRegistry;

abstract class RegisterTaggedServicesCompilerPassTestCase extends TestCase
{
    public function test()
    {
        $container = new ContainerBuilder();
        $container->setDefinition('registry', (new Definition(ServiceRegistry::class, [[]]))->setPublic(true));
        $container->setDefinition('service1', (new Definition(Service1::class))->addTag('service'));
        $container->setDefinition('service2', (new Definition(Service2::class))->addTag('service'));
        $container->setDefinition('service3', (new Definition(Service3::class))->addTag('service'));

        $container->addCompilerPass($this->createCompilerPass());
        $container->compile();

        /** @var ServiceRegistry|mixed $registry */
        $registry = $container->get('registry');
        self::assertInstanceOf(ServiceRegistry::class, $registry);
        self::assertCount(3, $registry->services);
        self::assertInstanceOf(Service1::class, $registry->services[0]);
        self::assertInstanceOf(Service2::class, $registry->services[1]);
        self::assertInstanceOf(Service3::class, $registry->services[2]);
    }

    /**
     * @return CompilerPassInterface
     */
    abstract protected function createCompilerPass();
}
