<?php

namespace Relaxsd\ICalendar\Properties\ChangeManagement;

use DateTime;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasDateTimeValue;

/**
 * Class LastModified
 *
 * 4.8.7.3 Last Modified
 *
 * Property Name: LAST-MODIFIED
 *
 * Purpose: The property specifies the date and time that the
 * information associated with the calendar component was last revised
 * in the calendar store.
 *
 * Note: This is analogous to the modification date and time for a
 * file in the file system.
 *
 * Value Type: DATE-TIME
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: This property can be specified in the "EVENT", "VTODO",
 * "VJOURNAL" or "VTIMEZONE" calendar components.
 *
 * Description: The property value MUST be specified in the UTC time
 * format.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * last-mod   = "LAST-MODIFIED" lstparam ":" date-time CRLF
 *
 * lstparam   = *(";" xparam)
 *
 * Example: The following is are examples of this property:
 *
 * LAST-MODIFIED:19960817T133000Z
 */
class LastModified
{
    use HasXParams,
        HasDateTimeValue;

    /**
     * LastModified constructor.
     *
     * @param DateTime|string|null $dateTime
     */
    public function __construct($dateTime = null)
    {
        if (isset($dateTime)) {
            $this->setDateTime($dateTime);
        }
    }

    /**
     * @param DateTime|string $dateTime
     *
     * @return $this
     */
    public static function make($dateTime)
    {
        return new self($dateTime);
    }

}
