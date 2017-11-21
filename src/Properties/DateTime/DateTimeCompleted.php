<?php

namespace Relaxsd\ICalendar\Properties\DateTime;

use DateTime;
use Relaxsd\ICalendar\Parameters\Traits\HasValueDataType;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\Traits\HasDateTimeValue;

/**
 * Class DateTimeCompleted
 *
 * 4.8.2.1 Date/Time Completed
 *
 * Property Name: COMPLETED
 *
 * Purpose: This property defines the date and time that a to-do was
 * actually completed.
 *
 * Value Type: DATE-TIME
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: The property can be specified in a "VTODO" calendar
 * component.
 *
 * Description: The date and time MUST be in a UTC format.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * completed  = "COMPLETED" compparam ":" date-time CRLF
 *
 * compparam  = *(";" xparam)
 *
 * Example: The following is an example of this property:
 *
 * COMPLETED:19960401T235959Z
 */
class DateTimeCompleted
{
    use HasXParams,
        HasValueDataType,
        HasDateTimeValue;

    /**
     * DateTimeCompleted constructor.
     *
     * @param DateTime|string|null $dateTime
     */
    public function __construct($dateTime = null)
    {
        if (isset($dateTime)) {
            $this
                ->setValueDataType(ValueDataType::VALUETYPE_DATE_TIME)
                ->setDateTime($dateTime);
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
