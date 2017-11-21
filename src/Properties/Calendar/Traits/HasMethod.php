<?php

namespace Relaxsd\ICalendar\Properties\Calendar\Traits;

use Relaxsd\ICalendar\Properties\Calendar\Method;

/**
 * Trait HasMethod
 *
 * @see     \Relaxsd\ICalendar\Properties\Calendar\Method
 *
 * @package Relaxsd\ICalendar\Properties\Calendar\Traits
 */
trait HasMethod
{

    /** @var  \Relaxsd\ICalendar\Properties\Calendar\Method */
    protected $method;

    /**
     * @return Method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\Method|string $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = ($method instanceof Method)
            ? $method
            : new Method($method);

        return $this;
    }

}
