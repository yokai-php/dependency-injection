<?php

namespace Yokai\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Definition;

/**
 * @author Yann Eugoné <yeugone@prestaconcept.net>
 */
class ArgumentRegisterTaggedServicesCompilerPass extends RegisterTaggedServicesCompilerPass
{
    /**
     * @var int
     */
    private $index;

    /**
     * @inheritDoc
     *
     * @param int $index
     */
    public function __construct($service, $tag, $interface, $index)
    {
        parent::__construct($service, $tag, $interface);

        $this->index = $index;
    }

    /**
     * @inheritDoc
     */
    protected function registerServices(Definition $definition, array $references)
    {
        $definition->replaceArgument($this->index, $references);
    }
}
