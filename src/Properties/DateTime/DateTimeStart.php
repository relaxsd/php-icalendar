<?php

namespace Relaxsd\ICalendar\Properties\DateTime;

use DateTime;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Parameters\Traits\HasValueDataType;
use Relaxsd\ICalendar\Parameters\Traits\HasTimeZoneIdentifier;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasDateTimeValue;

/**
 * Class DateTimeStart
 *
 * 4.8.2.4 Date/Time Start
 *
 * Property Name: DTSTART
 *
 * Purpose: This property specifies when the calendar component begins.
 *
 * Value Type: The default value type is DATE-TIME. The time value MUST
 * be one of the forms defined for the DATE-TIME value type. The value
 * type can be set to a DATE value type.
 *
 * Property Parameters: Non-standard, value data type, time zone
 * identifier property parameters can be specified on this property.
 *
 * Conformance: This property can be specified in the "VEVENT", "VTODO",
 * "VFREEBUSY", or "VTIMEZONE" calendar components.
 *
 * Description: Within the "VEVENT" calendar component, this property
 * defines the start date and time for the event. The property is
 * REQUIRED in "VEVENT" calendar components. Events can have a start
 * date/time but no end date/time. In that case, the event does not take
 * up any time.
 *
 * Within the "VFREEBUSY" calendar component, this property defines the
 * start date and time for the free or busy time information. The time
 * MUST be specified in UTC time.
 *
 * Within the "VTIMEZONE" calendar component, this property defines the
 * effective start date and time for a time zone specification. This
 * property is REQUIRED within each STANDARD and DAYLIGHT part included
 * in "VTIMEZONE" calendar components and MUST be specified as a local
 * DATE-TIME without the "TZID" property parameter.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * dtstart    = "DTSTART" dtstparam ":" dtstval CRLF
 *
 * dtstparam  = *(
 *
 * ; the following are optional,
 * ; but MUST NOT occur more than once
 *
 * (";" "VALUE" "=" ("DATE-TIME" / "DATE")) /
 * (";" tzidparam) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *(";" xparam)
 *
 * )
 *
 *
 *
 * dtstval    = date-time / date
 * ;Value MUST match value type
 *
 * Example: The following is an example of this property:
 * DTSTART:19980118T073000Z
 */
class DateTimeStart
{
    use HasTimeZoneIdentifier,
        HasXParams,
        HasValueDataType,
        HasDateTimeValue;

    const DEFAULT_VALUE_TYPE = ValueDataType::VALUETYPE_DATE_TIME;

    /**
     * DateTimeStart constructor.
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
    public static function forDateTime($dateTime)
    {
        return new self($dateTime);
    }

    /**
     * @param DateTime|string $dateTime
     *
     * @return $this
     */
    public static function forDate($dateTime)
    {
        return new self($dateTime, ValueDataType::VALUETYPE_DATE);
    }

}
