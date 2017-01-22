<?php

namespace AdamWojs\LoadBalancer\Tests\Host;

use AdamWojs\LoadBalancer\Host\HostInterface;
use AdamWojs\LoadBalancer\Request\RequestInterface;

class Host implements HostInterface
{
    private $name;
    private $load;

    public function __construct(string $name, int $load = 0)
    {
        $this->name = $name;
        $this->load = $load;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLoad(): int
    {
        return $this->load;
    }

    public function setLoad(int $load)
    {
        $this->load = $load;
    }

    public function handleRequest(RequestInterface $request)
    {
    }
}
