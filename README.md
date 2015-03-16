Enrise Psr\Log extension
=================

[![Latest Stable Version](https://poser.pugx.org/enrise/psr-log-extension/v/stable.svg)](https://packagist.org/packages/enrise/psr-log-extension)
[![License](https://poser.pugx.org/enrise/psr-log-extension/license.svg)](https://packagist.org/packages/enrise/psr-log-extension)

This repository contains an extension on the `LoggerAwareTrait` that comes with the `Psr\Log` package.
It contains convenience methods to use the `LoggerAwareInterface` implementation in a safe way. Meaning you don't have 
to care whether the class you're implementing actually has a logger instance attached to it.

Usage example
-------------

The example below works whether a logger instance has been attached or not.

```php
use Psr\Log\LoggerAwareInterface;
use Enrise\Log\LoggerAwareTrait;

class Foo implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    function bar()
    {
        $this->logDebug('Write a debug statement to the log');
    }
}

$foo = new Foo();
$foo->bar(); // All fine

$foo->setLogger(new ConcreteLogger());
$foo->bar(); // Writes to the logger as usual
```
