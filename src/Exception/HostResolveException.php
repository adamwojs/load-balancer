<?php

namespace AdamWojs\LoadBalancer\Exception;

/**
 * HostResolveException
 */
class HostResolveException extends LoadBalancerException
{
    /**
     * HostResolveException constructor
     *
     * @param string $message Optional error message
     * @param int $code Optional error code
     * @param \Exception|null $previous Optional previous exception
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct("Unable to resolve host instance. " . $message, $code, $previous);
    }
}
