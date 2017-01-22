<?php

declare(strict_types=1);

namespace AdamWojs\LoadBalancer\Host;

use AdamWojs\LoadBalancer\Request\RequestInterface;

/**
 * Host instance interface
 *
 * @package AdamWojs\LoadBalancer
 */
interface HostInterface
{
    /**
     * Get current load
     *
     * @return int
     */
    public function getLoad(): int;

    /**
     * Pass the request to host
     *
     * @param RequestInterface $request
     * @return void
     */
    public function handleRequest(RequestInterface $request);
}
