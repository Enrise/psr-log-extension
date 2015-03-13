<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Enrise B.V.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author Richard Tuin <richard@enrise.com>
 */

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
