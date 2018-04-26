<?php

namespace Zebooka\Resizer;

use PHPUnit\Framework\TestCase;

class ConfigureTest extends TestCase
{
    public function test_has_parameters_with_required_values()
    {
        $this->assertEquals(
            array(
                Configure::P_VERBOSE_LEVEL,
                Configure::P_LOG_FILE,
                Configure::P_LOG_LEVEL,
                Configure::P_LIMIT,
                Configure::P_FROM,
                Configure::P_TO,
            ),
            Configure::parametersRequiringValues()
        );
    }

    public function test_has_parameters_usable_multiple_times()
    {
        $this->assertEquals(
            array(
                Configure::P_FROM,
            ),
            Configure::parametersUsableMultipleTimes()
        );
    }

    public function test_configure()
    {
        $configure = new Configure($this->argv());
        $this->assertEquals('/example/bin', $configure->executableName);
        $this->assertTrue($configure->help);
        $this->assertEquals(123, $configure->verboseLevel);
        $this->assertTrue($configure->simulate);
        $this->assertEquals(42, $configure->limit);
        $this->assertFalse($configure->recursive);
        $this->assertEquals(array('/path/1', '/path/2', '/path/3'), $configure->from);
        $this->assertEquals('/path/dst', $configure->to);
        $this->assertEquals('/tmp/example.log', $configure->logFile);
        $this->assertEquals(321, $configure->logLevel);
    }

    public function test_empty_configure()
    {
        $configure = new Configure(array());
        $this->assertNull($configure->executableName);
        $this->assertFalse($configure->help);
        $this->assertEquals(100, $configure->verboseLevel);
        $this->assertFalse($configure->simulate);
        $this->assertEquals(0, $configure->limit);
        $this->assertTrue($configure->recursive);
        $this->assertEquals(array(), $configure->from);
        $this->assertEquals(null, $configure->to);
        $this->assertNull($configure->logFile);
        $this->assertEquals(250, $configure->logLevel);
    }

    private function argv()
    {
        return array(
            '/example/bin',
            '-h',
            '-E',
            '123',
            '-s',
            '-l',
            '42',
            '-R',
            '-f',
            '/path/1',
            '-f',
            '/path/2',
            '/path/3',
            '-t',
            '/path/dst',
            '-D',
            '-c',
            '-Z',
            '-o',
            '/tmp/example.log',
            '-O',
            '321',
        );
    }

}
