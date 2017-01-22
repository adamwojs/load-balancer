<?php

declare(strict_types = 1);

namespace AdamWojs\LoadBalancer\Host;

/**
 * Collection of host instances
 */
class HostCollection implements HostCollectionInterface
{
    /**
     * @var array
     */
    private $hosts;

    public function __construct(array $hosts = [])
    {
        $this->hosts = $hosts;
    }

    /**
     * @inheritdoc
     */
    public function add(HostInterface $host)
    {
        $this->hosts[] = $host;
    }

    /**
     * @inheritdoc
     */
    public function contains(HostInterface $host): bool
    {
        return in_array($host, $this->hosts);
    }

    /**
     * @inheritdoc
     */
    public function remove(HostInterface $host)
    {
        if (($key = array_search($host, $this->hosts)) !== false) {
            unset($this->hosts[$key]);
        }
    }

    /**
     * @inheritdoc
     */
    public function isEmpty(): bool
    {
        return empty($this->hosts);
    }

    /**
     * @inheritdoc
     */
    public function count(): int
    {
        return count($this->hosts);
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->hosts);
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return isset($this->hosts[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return isset($this->hosts[$offset]) ? $this->hosts[$offset] : null;
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException("Unsupported operation.");
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException("Unsupported operation.");
    }
}
