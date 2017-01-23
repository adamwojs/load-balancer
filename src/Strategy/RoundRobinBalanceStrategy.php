<?php

declare(strict_types = 1);

namespace AdamWojs\LoadBalancer\Strategy;

use AdamWojs\LoadBalancer\Host\HostCollectionInterface;

/**
 * Pass the requests sequentially in rotation to each of the hosts in the list
 */
class RoundRobinBalanceStrategy implements BalanceStrategyInterface
{
    /**
     * @var int Index of last select host instance
     */
    private $index;

    public function __construct()
    {
        $this->index = 0;
    }

    /**
     * @inheritdoc
     */
    public function resolve(HostCollectionInterface $hosts)
    {
        if (!$hosts->isEmpty()) {
            $result = $hosts[$this->index % $hosts->count()];
            $this->index++;

            return $result;
        }

        return null;
    }
}
