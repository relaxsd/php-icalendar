<?php

namespace Relaxsd\ICalendar\Values\Traits;

/**
 * Trait HasUCTOffsetValue
 *
 * 4.3.14 UTC Offset
 *
 * Value Name: UTC-OFFSET
 *
 * Purpose: This value type is used to identify properties that contain
 * an offset from UTC to local time.
 *
 * Formal Definition: The data type is defined by the following
 * notation:
 *
 * utc-offset = time-numzone  ;As defined above in time data type
 *
 * time-numzone       = ("+" / "-") time-hour time-minute [time-
 * second]
 *
 * Description: The PLUS SIGN character MUST be specified for positive
 * UTC offsets (i.e., ahead of UTC). The value of "-0000" and "-000000"
 * are not allowed. The time-second, if present, may not be 60; if
 * absent, it defaults to zero.
 *
 * No additional content value encoding (i.e., BACKSLASH character
 * encoding) is defined for this value type.
 *
 * Example: The following UTC offsets are given for standard time for
 * New York (five hours behind UTC) and Geneva (one hour ahead of UTC):
 *
 * -0500
 *
 * +0100
 *
 */
trait HasUCTOffsetValue
{

    /**
     * @var string
     */
    protected $uctOffset;

    /**
     * @return string
     */
    public function getUCTOffset()
    {
        return $this->uctOffset;
    }

    /**
     * @param string $uctOffset
     *
     * @return $this
     */
    public function setUCTOffset($uctOffset)
    {
        $this->uctOffset = $uctOffset;
        return $this;
    }

}
