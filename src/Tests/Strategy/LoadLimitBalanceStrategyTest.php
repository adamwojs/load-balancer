<?php

namespace AdamWojs\LoadBalancer\Tests\Strategy;

use AdamWojs\LoadBalancer\Host\HostCollection;
use AdamWojs\LoadBalancer\Strategy\LoadLimitBalanceStrategy;
use AdamWojs\LoadBalancer\Tests\Host\Host;
use PHPUnit\Framework\TestCase;

class LoadLimitBalanceStrategyTest extends TestCase
{
    const TEST_LIMIT = 75;

    public function testResolve()
    {
        $a = new Host('A', 60);
        $b = new Host('B', 65);
        $c = new Host('C', 65);

        $collection = new HostCollection([$a, $b, $c]);

        $expected = [$a, $a, $b, $c, $b, $c];
        $strategy = new LoadLimitBalanceStrategy(self::TEST_LIMIT);
        for ($i = 0; $i < count($expected); $i++) {
            /** @var Host $host */
            $host = $strategy->resolve($collection);
            $host->setLoad($host->getLoad() + 10);

            $this->assertEquals($expected[$i], $host);
        }
    }
}
