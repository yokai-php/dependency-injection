<?php

namespace Yokai\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Declares CompilerPassInterface::process() with the "void" return type required since Symfony 8.0.
 *
 * @internal
 * @see RegisterTaggedServicesCompilerPass
 *
 * @author Yann Eugoné <yeugone@prestaconcept.net>
 */
trait ProcessWithReturnTypeTrait
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        $this->doProcess($container);
    }
}
