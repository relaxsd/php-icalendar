<?php

namespace Relaxsd\ICalendar\Properties\DateTime;

use DateTime;
use Relaxsd\ICalendar\Parameters\Traits\HasTimeZoneIdentifier;
use Relaxsd\ICalendar\Parameters\Traits\HasValueDataType;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\Traits\HasDateTimeValue;

/**
 * Class DateTimeDue
 *
 * 4.8.2.3 Date/Time Due
 *
 * Property Name: DUE
 *
 * Purpose: This property defines the date and time that a to-do is
 * expected to be completed.
 *
 * Value Type: The default value type is DATE-TIME. The value type can
 * be set to a DATE value type.
 *
 * Property Parameters: Non-standard, value data type, time zone
 * identifier property parameters can be specified on this property.
 *
 * Conformance: The property can be specified once in a "VTODO" calendar
 * component.
 *
 * Description: The value MUST be a date/time equal to or after the
 * DTSTART value, if specified.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * due        = "DUE" dueparam":" dueval CRLF
 * dueparam   = *(
 * ; the following are optional,
 * ; but MUST NOT occur more than once
 *
 * (";" "VALUE" "=" ("DATE-TIME" / "DATE")) /
 * (";" tzidparam) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 *(";" xparam)
 *
 * )
 *
 * dueval     = date-time / date
 * ;Value MUST match value type
 *
 * Example: The following is an example of this property:
 *
 * DUE:19980430T235959Z
 */
class DateTimeDue
{
    use HasTimeZoneIdentifier,
        HasXParams,
        HasValueDataType,
        HasDateTimeValue;

    /**
     * DateTimeDue constructor.
     *
     * @param DateTime|string|null                               $dateTime
     * @param \Relaxsd\ICalendar\Parameters\ValueDataType|string $valueType
     */
    public function __construct($dateTime = null, $valueType = ValueDataType::VALUETYPE_DATE_TIME)
    {
        if (isset($dateTime)) {
            $this
                ->setValueDataType($valueType ?: ValueDataType::determineValueType($dateTime))
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

    /**
     * @param DateTime|string $dateTime
     *
     * @return $this
     */
    public static function createDate($dateTime)
    {
        return new self($dateTime, ValueDataType::VALUETYPE_DATE);
    }

}
