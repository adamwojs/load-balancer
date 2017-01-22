<?php

namespace AdamWojs\LoadBalancer\Exception;

/**
 * Base load balancer exception
 */
class LoadBalancerException extends \Exception
{
    /**
     * LoadBalancerException constructor.
     *
     * @param string $message Optional error message
     * @param int $code Optional error code
     * @param \Exception|null $previous Optional previous exception
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
