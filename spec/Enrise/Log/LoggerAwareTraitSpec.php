<?php

namespace spec\Enrise\Log;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LoggerAwareTraitSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('spec\Enrise\Log\LoggerAwareTraitStub');
    }

    public function it_implements_the_logger_aware_interface()
    {
        $this->shouldImplement('\Psr\Log\LoggerAwareInterface');
    }

    public function it_does_not_throw_fatal_error_when_no_logger_is_attached()
    {
        $this->callMethod('logDebug', 'foo-debug');
    }

    public function it_proxies_log_calls_to_the_logger(LoggerInterface $logger)
    {
        $this->setLogger($logger);

        $logger->log(LogLevel::DEBUG, 'foo-debug', [])->shouldBeCalled();
        $logger->log(LogLevel::INFO, 'foo-info', [])->shouldBeCalled();
        $logger->log(LogLevel::NOTICE, 'foo-notice', [])->shouldBeCalled();
        $logger->log(LogLevel::WARNING, 'foo-warning', [])->shouldBeCalled();
        $logger->log(LogLevel::ERROR, 'foo-error', [])->shouldBeCalled();
        $logger->log(LogLevel::CRITICAL, 'foo-critical', [])->shouldBeCalled();
        $logger->log(LogLevel::ALERT, 'foo-alert', [])->shouldBeCalled();
        $logger->log(LogLevel::EMERGENCY, 'foo-emergency', [])->shouldBeCalled();

        $this->callMethod('logDebug', 'foo-debug');
        $this->callMethod('logInfo', 'foo-info');
        $this->callMethod('logNotice', 'foo-notice');
        $this->callMethod('logWarning', 'foo-warning');
        $this->callMethod('logError', 'foo-error');
        $this->callMethod('logCritical', 'foo-critical');
        $this->callMethod('logAlert', 'foo-alert');
        $this->callMethod('logEmergency', 'foo-emergency');
    }
}
