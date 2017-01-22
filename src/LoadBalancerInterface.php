<?php

declare(strict_types=1);

namespace AdamWojs\LoadBalancer;

use AdamWojs\LoadBalancer\Request\RequestInterface;

/**
 * Load balancer interface
 *
 * @package AdamWojs\LoadBalancer
 */
interface LoadBalancerInterface
{
    /**
     * Load balance request
     *
     * @param RequestInterface $request Request to balance
     * @return void
     */
    public function handleRequest(RequestInterface $request);
}
