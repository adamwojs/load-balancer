<?php

namespace AdamWojs\LoadBalancer\Tests\Strategy;

use AdamWojs\LoadBalancer\Host\HostCollection;
use AdamWojs\LoadBalancer\Strategy\RoundRobinBalanceStrategy;
use AdamWojs\LoadBalancer\Tests\Host\Host;
use PHPUnit\Framework\TestCase;

class RoundRobinBalanceStrategyTest extends TestCase
{
    public function testResolve()
    {
        $a = new Host('A');
        $b = new Host('B');
        $c = new Host('C');

        $collection = new HostCollection([$a, $b, $c]);

        $strategy = new RoundRobinBalanceStrategy();
        for ($i = 0; $i < 3; $i++) {
            foreach ([$a, $b, $c] as $expected) {
                $this->assertEquals($expected, $strategy->resolve($collection));
            }
        }
    }

    public function testResolveOnEmptyHostCollection()
    {
        $strategy = new RoundRobinBalanceStrategy();
        $this->assertNull($strategy->resolve(new HostCollection([])));
    }
}
