<?php

namespace spec\Enrise\Log;

use Enrise\Log\LoggerAwareTrait;
use Psr\Log\LoggerAwareInterface;

class LoggerAwareTraitStub implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * Since we can only test the trait's behaviour via an implementation,
     * we have to call the protected methods via a proxy method.
     *
     * @param $method
     * @param $message
     * @return mixed
     */
    public function callMethod($method, $message)
    {
        return $this->$method($message);
    }
}
