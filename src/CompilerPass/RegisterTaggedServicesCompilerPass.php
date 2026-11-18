<?php

namespace Yokai\DependencyInjection\CompilerPass;

use LogicException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

// Symfony 8.0 declares CompilerPassInterface::process() with a "void" return type,
// a syntax that PHP < 7.1 cannot parse: process() is declared by the trait matching the installed Symfony version.
if (\PHP_VERSION_ID >= 70100 && (new \ReflectionMethod(CompilerPassInterface::class, 'process'))->hasReturnType()) {
    class_alias(ProcessWithReturnTypeTrait::class, ProcessTrait::class);
} else {
    class_alias(ProcessWithoutReturnTypeTrait::class, ProcessTrait::class);
}

/**
 * @author Yann Eugoné <yeugone@prestaconcept.net>
 */
abstract class RegisterTaggedServicesCompilerPass implements CompilerPassInterface
{
    use ProcessTrait;

    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var null|string
     */
    private $interface;

    /**
     * @param string      $service
     * @param string      $tag
     * @param string|null $interface
     */
    public function __construct($service, $tag, $interface = null)
    {
        $this->service = $service;
        $this->tag = $tag;
        $this->interface = $interface;
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    private function doProcess(ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->service) && !$container->hasAlias($this->service)) {
            throw new LogicException(
                sprintf(
                    'The service "%s" is not registered',
                    $this->service
                )
            );
        }

        $services = [];

        foreach ($container->findTaggedServiceIds($this->tag) as $serviceId => $tags) {

            if (null !== $this->interface) {
                $serviceDefinition = $container->getDefinition($serviceId);
                if (!in_array($this->interface, class_implements($serviceDefinition->getClass()))) {
                    throw new LogicException(
                        sprintf(
                            'The service "%s" must implement "%s" interface to be registered under the "%s" tag.',
                            $serviceId,
                            $this->interface,
                            $this->tag
                        )
                    );
                }
            }

            foreach ($tags as $attributes) {
                $priority = isset($attributes['priority']) ? $attributes['priority'] : 0;
                $services[$priority][] = new Reference($serviceId);
            }
        }

        ksort($services);

        if (count($services) > 0) {
            // Flatten the array
            $references = call_user_func_array('array_merge', $services);
        } else {
            $references = [];
        }

        $definition = $container->findDefinition($this->service);

        $this->registerServices($definition, $references);
    }

    /**
     * @param Definition $definition
     * @param array      $references
     */
    abstract protected function registerServices(Definition $definition, array $references);
}
