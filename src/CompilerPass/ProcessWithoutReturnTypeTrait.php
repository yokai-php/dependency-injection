<?php

namespace Yokai\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Declares CompilerPassInterface::process() without return type, as Symfony < 8.0 expects it.
 *
 * @internal
 * @see RegisterTaggedServicesCompilerPass
 *
 * @author Yann Eugoné <yeugone@prestaconcept.net>
 */
trait ProcessWithoutReturnTypeTrait
{
    /**
     * @inheritDoc
     *
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $this->doProcess($container);
    }
}
