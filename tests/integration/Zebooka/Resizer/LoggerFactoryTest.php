<?php

namespace Zebooka\Resizer;

class LoggerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_factory()
    {
        $configure = \Mockery::mock('\\Zebooka\\Resizer\\Configure');
        $logger = LoggerFactory::logger($configure);
        $this->assertInstanceOf('\\Monolog\\Logger', $logger);
    }
}
