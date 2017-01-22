<?php

declare(strict_types = 1);

namespace AdamWojs\LoadBalancer\Host;

/**
 * Collection of host instances interface
 */
interface HostCollectionInterface extends \Countable, \IteratorAggregate, \ArrayAccess
{
    /**
     * Add host instance to collection
     *
     * @param HostInterface $host
     * @return void
     */
    public function add(HostInterface $host);

    /**
     * Check if collection contains host instance.
     *
     * @param HostInterface $host
     * @return bool
     */
    public function contains(HostInterface $host): bool;

    /**
     * Remove host instance from collection
     *
     * @param HostInterface $host
     * @return void
     */
    public function remove(HostInterface $host);

    /**
     * Check if collection does't contain any host instance
     *
     * @return bool
     */
    public function isEmpty(): bool;
}
