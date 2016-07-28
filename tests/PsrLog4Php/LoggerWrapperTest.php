<?php

namespace AbacaphiliacTest\PsrLog4Php;

use Abacaphiliac\PsrLog4Php\LoggerWrapper;
use Psr\Log\LogLevel;

/**
 * @covers \Abacaphiliac\PsrLog4Php\LoggerWrapper
 */
class LoggerWrapperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|\Logger */
    private $logger;
    /** @var LoggerWrapper */
    private $sut;

    protected function setUp()
    {
        parent::setUp();

        $this->logger = $this->getMockBuilder('\Logger')->disableOriginalConstructor()->getMock();
        
        $this->sut = new LoggerWrapper($this->logger);
    }

    /**
     * @return array[]
     */
    public function dataLog()
    {
        return array(
            'emergency' => array('emergency', \LoggerLevel::getLevelFatal()),
            'alert' => array('alert', \LoggerLevel::getLevelFatal()),
            'critical' => array('critical', \LoggerLevel::getLevelFatal()),
            'error' => array('error', \LoggerLevel::getLevelError()),
            'warning' => array('warning', \LoggerLevel::getLevelWarn()),
            'notice' => array('notice', \LoggerLevel::getLevelWarn()),
            'info' => array('info', \LoggerLevel::getLevelInfo()),
            'debug' => array('debug', \LoggerLevel::getLevelDebug()),
        );
    }

    /**
     * @dataProvider dataLog
     * @param string $method
     * @param string $level
     */
    public function testLog($method, $level)
    {
        $message = 'FooBar';
        $context = array('Foo' => 'Bar');
        
        $this->logger->expects(self::once())->method('log')
            ->with($level, self::isType('string'));
        
        $this->sut->{$method}($message, $context);
    }
    
    public function testPsrLogLevelIsMapped()
    {
        $this->logger->expects(self::once())->method('log')
            ->with(\LoggerLevel::getLevelFatal(), self::isType('string'));

        $this->sut->log(LogLevel::EMERGENCY, 'FooBar', array('Foo' => 'Bar'));
    }
    
    public function testInvalidLogLevelIsMappedToDefault()
    {
        $this->logger->expects(self::once())->method('log')
            ->with(\LoggerLevel::getLevelError(), self::isType('string'));

        $this->sut->log('InvalidLevel', 'FooBar', array('Foo' => 'Bar'));
    }
    
    public function testLogExceptionViaRenderer()
    {
        \Logger::configure(array(
            'appenders' => array(
                'echo' => array(
                    'class' => '\LoggerAppenderEcho',
                ),
            ),
            'rootLogger' => array(
                'level' => 'ERROR',
                'appenders' => array(
                    'echo',
                ),
            ),
            'renderers' => array(
                'Exception' => array(
                    'renderedClass' => 'AbacaphiliacTest\PsrLog4Php\FooBar',
                    'renderingClass' => 'AbacaphiliacTest\PsrLog4Php\FooBarRenderer',
                ),
            ),
        ), new \LoggerConfiguratorDefault());
        
        $logger = \Logger::getLogger(__METHOD__);
        
        $sut = new LoggerWrapper($logger);
        
        ob_start();
        $sut->error(new FooBar('FizzBuzz'));
        $actual = ob_get_clean();
        
        self::assertEquals("ERROR - FizzBuzz\n", $actual);
    }
}
