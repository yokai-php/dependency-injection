<?php

namespace Yokai\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Definition;

/**
 * @author Yann Eugoné <yeugone@prestaconcept.net>
 */
class SetterRegisterTaggedServicesCompilerPass extends RegisterTaggedServicesCompilerPass
{
    /**
     * @var string
     */
    private $method;

    /**
     * @inheritDoc
     *
     * @param string $index
     */
    public function __construct($service, $tag, $interface, $index)
    {
        parent::__construct($service, $tag, $interface);

        $this->method = $index;
    }

    /**
     * @inheritDoc
     */
    protected function registerServices(Definition $definition, array $references)
    {
        $definition->addMethodCall($this->method, [$references]);
    }
}
