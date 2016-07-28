<?php

namespace Abacaphiliac\PsrLog4Php;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class LoggerWrapper extends AbstractLogger
{
    /** @var \Logger */
    private $logger;
    
    /** @var DefaultFormatter */
    private $formatter;

    /** @var int[] */
    private $levels;
    
    /** @var string */
    private $defaultLevel;

    /**
     * Log4PhpPsr3Wrapper constructor.
     * @param \Logger $logger
     * @param FormatterInterface $formatter
     * @param int[] $levels
     * @param string $defaultLevel
     */
    public function __construct(
        \Logger $logger,
        FormatterInterface $formatter = null,
        array $levels = array(),
        $defaultLevel = LogLevel::ERROR
    ) {
        if (!$formatter) {
            $formatter = new DefaultFormatter();
        }
        
        if (!$levels) {
            $levels = array(
                LogLevel::EMERGENCY => \LoggerLevel::FATAL,
                LogLevel::ALERT => \LoggerLevel::FATAL,
                LogLevel::CRITICAL => \LoggerLevel::FATAL,
                LogLevel::ERROR => \LoggerLevel::ERROR,
                LogLevel::WARNING => \LoggerLevel::WARN,
                LogLevel::NOTICE => \LoggerLevel::WARN,
                LogLevel::INFO => \LoggerLevel::INFO,
                LogLevel::DEBUG => \LoggerLevel::DEBUG,
            );
        }
        
        $this->logger = $logger;
        $this->formatter = $formatter;
        $this->levels = $levels;
        $this->defaultLevel = $defaultLevel;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param mixed $message
     * @param mixed[] $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        if (!array_key_exists($level, $this->levels)) {
            $level = $this->defaultLevel;
        }
        
        $level = \LoggerLevel::toLevel($this->levels[$level], $this->defaultLevel);
        
        $message = $this->formatter->format($level, $message, $context);

        $this->logger->log($level, $message);
    }
}
