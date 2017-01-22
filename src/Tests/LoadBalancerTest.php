<?php

namespace AdamWojs\LoadBalancer\Tests;

use AdamWojs\LoadBalancer\Exception\HostResolveException;
use AdamWojs\LoadBalancer\Host\HostCollection;
use AdamWojs\LoadBalancer\Host\HostInterface;
use AdamWojs\LoadBalancer\LoadBalancer;
use AdamWojs\LoadBalancer\Strategy\BalanceStrategyInterface;
use AdamWojs\LoadBalancer\Tests\Request\Request;
use PHPUnit\Framework\TestCase;

class LoadBalancerTest extends TestCase
{
    public function testHandleRequest()
    {
        $request = new Request();

        $hostMock = $this->createMock(HostInterface::class);
        $hostMock
            ->expects($this->once())
            ->method('handleRequest')
            ->with($request);

        $collection = new HostCollection([$hostMock]);

        $strategyMock = $this->createMock(BalanceStrategyInterface::class);
        $strategyMock
            ->expects($this->once())
            ->method('resolve')
            ->with($collection)
            ->willReturn($hostMock);

        $balancer = new LoadBalancer(new HostCollection([$hostMock]), $strategyMock);
        $balancer->handleRequest($request);
    }

    public function testHostResolveException()
    {
        $this->expectException(HostResolveException::class);

        $strategyMock = $this->createMock(BalanceStrategyInterface::class);
        $strategyMock
            ->expects($this->once())
            ->method('resolve')
            ->willReturn(null);

        $balancer = new LoadBalancer(new HostCollection([]), $strategyMock);
        $balancer->handleRequest(new Request());

    }

}
