<?php

namespace Yokai\DependencyInjection\Tests\Fixtures;

class ServiceRegistry
{
    /**
     * @var array<ServiceInterface>
     */
    public $services;

    public function __construct(array $services = [])
    {
        $this->services = $services;
    }

    /**
     * @param array<ServiceInterface> $services
     */
    public function setServices(array $services)
    {
        $this->services = $services;
    }

    public function addService(ServiceInterface $service)
    {
        $this->services[] = $service;
    }
}
