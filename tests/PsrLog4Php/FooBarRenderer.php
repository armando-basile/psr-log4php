<?php

namespace AbacaphiliacTest\PsrLog4Php;

class FooBarRenderer implements \LoggerRenderer
{
    /**
     * Renders the entity passed as <var>input</var> to a string.
     * @param mixed $input The entity to render.
     * @return string The rendered string.
     */
    public function render($input)
    {
        if ($input instanceof FooBar) {
            return $input->getValue();
        }
        
        return '';
    }
}
