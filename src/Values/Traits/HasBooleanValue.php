<?php

namespace Relaxsd\ICalendar\Values\Traits;

/**
 * Trait HasBooleanValue
 *
 * 4.3.2   Boolean
 *
 * Value Name: BOOLEAN
 *
 * Purpose: This value type is used to identify properties that contain
 * either a "TRUE" or "FALSE" Boolean value.
 *
 * Formal Definition: The value type is defined by the following
 * notation:
 *
 * boolean    = "TRUE" / "FALSE"
 *
 * Description: These values are case insensitive text. No additional
 * content value encoding (i.e., BACKSLASH character encoding) is
 * defined for this value type.
 *
 * Example: The following is an example of a hypothetical property that
 * has a BOOLEAN value type:
 *
 * GIBBERISH:TRUE
 *
 */
trait HasBooleanValue
{

    /**
     * @var boolean
     */
    protected $value;

    /**
     * @return boolean
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param boolean $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

}
