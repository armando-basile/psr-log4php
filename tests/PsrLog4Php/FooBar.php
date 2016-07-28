<?php

namespace AbacaphiliacTest\PsrLog4Php;

class FooBar
{
    /** @var string */
    private $value;

    /**
     * FooBar constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
