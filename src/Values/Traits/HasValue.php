<?php

namespace Relaxsd\ICalendar\Values\Traits;

/**
 * Trait HasValue
 */
trait HasValue
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return HasValue
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }


}
