<?php

namespace AbacaphiliacTest\PsrLog4Php;

use Abacaphiliac\PsrLog4Php\DefaultFormatter;
use Psr\Log\LogLevel;

class DefaultFormatterTest extends \PHPUnit_Framework_TestCase
{
    /** @var DefaultFormatter */
    private $sut;

    protected function setUp()
    {
        parent::setUp();

        $this->sut = new DefaultFormatter();
    }
    
    public function testFormatString()
    {
        $actual = $this->sut->format(LogLevel::INFO, 'FooBar', array('Fizz' => 'Buzz'));
        
        self::assertContains('FooBar', $actual);
        self::assertContains('Fizz', $actual);
        self::assertContains('Buzz', $actual);
    }
    
    public function testFormatNonString()
    {
        $actual = $this->sut->format(LogLevel::INFO, $expected = new \stdClass(), array('Fizz' => 'Buzz'));
        
        self::assertSame($expected, $actual);
    }
}
