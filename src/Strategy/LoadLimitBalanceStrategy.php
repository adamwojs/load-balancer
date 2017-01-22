<?php

declare(strict_types = 1);

namespace AdamWojs\LoadBalancer\Strategy;

use AdamWojs\LoadBalancer\Host\HostCollectionInterface;
use AdamWojs\LoadBalancer\Host\HostInterface;

/**
 * Take the first host that has a load under LIMIT or one with the lowest load if
 * all hosts in the list are above LIMIT
 */
class LoadLimitBalanceStrategy implements BalanceStrategyInterface
{
    private $loadLimit;

    public function __construct($limit)
    {
        $this->loadLimit = $limit;
    }

    /**
     * @inheritdoc
     */
    public function resolve(HostCollectionInterface $hosts)
    {
        /** @var HostInterface $result */
        $result = null;

        foreach ($hosts as $host) {
            if ($host->getLoad() < $this->getLoadLimit()) {
                return $host;
            }

            if ($result == null || $host->getLoad() < $result->getLoad()) {
                $result = $host;
            }
        }

        return $result;
    }

    public function getLoadLimit(): int
    {
        return $this->loadLimit;
    }
}
