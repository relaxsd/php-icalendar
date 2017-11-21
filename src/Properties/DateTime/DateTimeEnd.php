<?php

namespace Relaxsd\ICalendar\Properties\DateTime;

use DateTime;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Parameters\Traits\HasValueDataType;
use Relaxsd\ICalendar\Parameters\Traits\HasTimeZoneIdentifier;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasDateTimeValue;

/**
 * Class DateTimeEnd
 *
 * 4.8.2.2 Date/Time End
 *
 * Property Name: DTEND
 *
 * Purpose: This property specifies the date and time that a calendar
 * component ends.
 *
 * Value Type: The default value type is DATE-TIME. The value type can
 * be set to a DATE value type.
 *
 * Property Parameters: Non-standard, value data type, time zone
 * identifier property parameters can be specified on this property.
 *
 * Conformance: This property can be specified in "VEVENT" or
 * "VFREEBUSY" calendar components.
 *
 * Description: Within the "VEVENT" calendar component, this property
 * defines the date and time by which the event ends. The value MUST be
 * later in time than the value of the "DTSTART" property.
 *
 * Within the "VFREEBUSY" calendar component, this property defines the
 * end date and time for the free or busy time information. The time
 * MUST be specified in the UTC time format. The value MUST be later in
 * time than the value of the "DTSTART" property.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * dtend      = "DTEND" dtendparam":" dtendval CRLF
 *
 * dtendparam = *(
 *
 * ; the following are optional,
 * ; but MUST NOT occur more than once
 *
 * (";" "VALUE" "=" ("DATE-TIME" / "DATE")) /
 * (";" tzidparam) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 * (";" xparam)
 *
 * )
 *
 * dtendval   = date-time / date
 * ;Value MUST match value type
 *
 * Example: The following is an example of this property:
 *
 * DTEND:19960401T235959Z
 *
 * DTEND;VALUE=DATE:19980704
 */
class DateTimeEnd
{
    use HasTimeZoneIdentifier,
        HasXParams,
        HasValueDataType,
        HasDateTimeValue;

    /**
     * DateTimeEnd constructor.
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
