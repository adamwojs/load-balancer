<?php

declare(strict_types=1);

namespace AdamWojs\LoadBalancer\Strategy;

use AdamWojs\LoadBalancer\Host\HostCollectionInterface;
use AdamWojs\LoadBalancer\Host\HostInterface;

/**
 * Load balancing strategy interface
 *
 * @package AdamWojs\LoadBalancer\Strategy
 */
interface BalanceStrategyInterface
{
    /**
     * Select host instance to handle request
     *
     * @param HostCollectionInterface $collection
     * @return HostInterface
     */
    public function resolve(HostCollectionInterface $collection);
}
