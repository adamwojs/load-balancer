<?php

require_once "../vendor/autoload.php";

use AdamWojs\LoadBalancer\Host\HostInterface;
use AdamWojs\LoadBalancer\Host\HostCollection;
use AdamWojs\LoadBalancer\LoadBalancer;
use AdamWojs\LoadBalancer\Request\RequestInterface;
use AdamWojs\LoadBalancer\Strategy\LoadLimitBalanceStrategy;
use AdamWojs\LoadBalancer\Strategy\RoundRobinBalanceStrategy;

// 1) Implement HostInterface
class Host implements HostInterface
{
    private $name;
    private $load;

    public function __construct($name, $load = 0)
    {
        $this->name = $name;
        $this->load = $load;
    }

    public function getLoad(): int
    {
        return $this->load;
    }

    public function handleRequest(RequestInterface $request)
    {
        $this->load++;

        // Simple print host name
        echo "HOST ".$this->name."\n";
    }
}

// 2) Implement RequestInterface
$request = new class implements RequestInterface {};

// 3) Define collection of host instances that will be load balanced
$hosts = new HostCollection();
$hosts->add(new Host("A", 100));
$hosts->add(new Host("B", 78));
$hosts->add(new Host("C", 85));

// 4) Create load balance strategy
$strategy = new LoadLimitBalanceStrategy(75);

// 5) Create load balancer instances
$balancer = new LoadBalancer($hosts, $strategy);
for ($i = 0; $i < 12; $i++) {
    $balancer->handleRequest($request);
}
