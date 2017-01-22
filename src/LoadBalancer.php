<?php

declare(strict_types=1);

namespace AdamWojs\LoadBalancer;

use AdamWojs\LoadBalancer\Exception\HostResolveException;
use AdamWojs\LoadBalancer\Exception\LoadBalancerException;
use AdamWojs\LoadBalancer\Host\HostCollection;
use AdamWojs\LoadBalancer\Host\HostCollectionInterface;
use AdamWojs\LoadBalancer\Request\RequestInterface;
use AdamWojs\LoadBalancer\Strategy\BalanceStrategyInterface;

/**
 * LoadBalancer
 *
 * @package AdamWojs\LoadBalancer
 */
class LoadBalancer implements LoadBalancerInterface
{
    /**
     * @var HostCollectionInterface
     */
    private $hosts;

    /**
     * @var BalanceStrategyInterface
     */
    private $strategy;

    /**
     * LoadBalancer constructor.
     *
     * @param HostCollection $hosts List of host instances that should be load balanced
     * @param BalanceStrategyInterface $strategy Variant of load balancing algorithm
     */
    public function __construct(HostCollectionInterface $hosts, BalanceStrategyInterface $strategy)
    {
        $this->hosts = clone $hosts;
        $this->strategy = $strategy;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest(RequestInterface $request)
    {
        $instance = $this->strategy->resolve($this->hosts);

        if ($instance === null) {
            throw new HostResolveException("Unresolved target host instance.");
        }

        try {
            $instance->handleRequest($request);
        } catch (\Exception $ex) {
            throw new LoadBalancerException($ex->getMessage(), $ex->getCode(), $ex);
        }
    }
}
