<?php

namespace Relaxsd\ICalendar\Properties\ChangeManagement;

use DateTime;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasDateTimeValue;

/**
 * Class DateTimeCreated
 *
 * 4.8.7.1 Date/Time Created
 *
 * Property Name: CREATED
 *
 * Purpose: This property specifies the date and time that the calendar
 * information was created by the calendar user agent in the calendar
 * store.
 *
 * Note: This is analogous to the creation date and time for a file
 * in the file system.
 *
 * Value Type: DATE-TIME
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: The property can be specified once in "VEVENT", "VTODO"
 * or "VJOURNAL" calendar components.
 *
 * Description: The date and time is a UTC value.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * created    = "CREATED" creaparam ":" date-time CRLF
 *
 * creaparam  = *(";" xparam)
 *
 * Example: The following is an example of this property:
 *
 * CREATED:19960329T133000Z
 */
class DateTimeCreated
{
    use HasXParams,
        HasDateTimeValue;

    /**
     * DateTimeCreated constructor.
     *
     * @param DateTime|string|null                          $dateTime
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
