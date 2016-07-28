<?php

namespace Abacaphiliac\PsrLog4Php;

class DefaultFormatter implements FormatterInterface
{
    /**
     * @param mixed $level
     * @param mixed $message
     * @param mixed[] $context
     * @return mixed
     */
    public function format($level, $message, array $context = array())
    {
        if (is_string($message)) {
            return $message . ' ' . json_encode($context);
        }

        // Cannot append encoded context without causing an error, or blocking log4php object renderers.
        return $message;
    }
}
