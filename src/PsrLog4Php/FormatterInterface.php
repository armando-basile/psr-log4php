<?php

namespace Abacaphiliac\PsrLog4Php;

interface FormatterInterface
{
    /**
     * @param mixed $level
     * @param mixed $message
     * @param mixed[] $context
     * @return mixed
     */
    public function format($level, $message, array $context = array());
}
