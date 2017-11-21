<?php

namespace Relaxsd\ICalendar\Properties\Recurrence;

use DateTime;
use Relaxsd\ICalendar\Parameters\Traits\HasTimeZoneIdentifier;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\Period;
use Relaxsd\ICalendar\Values\RecurrenceDate as RecurrenceDateValue;
use Relaxsd\ICalendar\Values\Traits\HasRecurrenceDateValues;

/**
 * Class RecurrenceDate
 *
 * 4.8.5.3 Recurrence Date/Times
 *
 * Property Name: RDATE
 *
 * Purpose: This property defines the list of date/times for a
 * recurrence set.
 *
 * Value Type: The default value type for this property is DATE-TIME.
 * The value type can be set to DATE or PERIOD.
 *
 * Property Parameters: Non-standard, value data type and time zone
 * identifier property parameters can be specified on this property.
 *
 * Conformance: The property can be specified in "VEVENT", "VTODO",
 * "VJOURNAL" or "VTIMEZONE" calendar components.
 *
 * Description: This property can appear along with the "RRULE" property
 * to define an aggregate set of repeating occurrences. When they both
 * appear in an iCalendar object, the recurring events are defined by
 * the union of occurrences defined by both the "RDATE" and "RRULE".
 *
 * The recurrence dates, if specified, are used in computing the
 * recurrence set. The recurrence set is the complete set of recurrence
 * instances for a calendar component. The recurrence set is generated
 * by considering the initial "DTSTART" property along with the "RRULE",
 * "RDATE", "EXDATE" and "EXRULE" properties contained within the
 * iCalendar object. The "DTSTART" property defines the first instance
 * in the recurrence set. Multiple instances of the "RRULE" and "EXRULE"
 * properties can also be specified to define more sophisticated
 * recurrence sets. The final recurrence set is generated by gathering
 * all of the start date/times generated by any of the specified "RRULE"
 * and "RDATE" properties, and excluding any start date/times which fall
 * within the union of start date/times generated by any specified
 * "EXRULE" and "EXDATE" properties. This implies that start date/times
 * within exclusion related properties (i.e., "EXDATE" and "EXRULE")
 * take precedence over those specified by inclusion properties (i.e.,
 * "RDATE" and "RRULE"). Where duplicate instances are generated by the
 * "RRULE" and "RDATE" properties, only one recurrence is considered.
 * Duplicate instances are ignored.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * rdate      = "RDATE" rdtparam ":" rdtval *("," rdtval) CRLF
 *
 * rdtparam   = *(
 *
 * ; the following are optional,
 * ; but MUST NOT occur more than once
 *
 * (";" "VALUE" "=" ("DATE-TIME" / "DATE" / "PERIOD")) /
 * (";" tzidparam) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 * (";" xparam)
 *
 * )
 *
 * rdtval     = date-time / date / period
 * ;Value MUST match value type
 *
 * Example: The following are examples of this property:
 *
 * RDATE:19970714T123000Z
 *
 * RDATE;TZID=US-EASTERN:19970714T083000
 *
 * RDATE;VALUE=PERIOD:19960403T020000Z/19960403T040000Z,
 * 19960404T010000Z/PT3H
 *
 * RDATE;VALUE=DATE:19970101,19970120,19970217,19970421
 * 19970526,19970704,19970901,19971014,19971128,19971129,19971225
 *
 * @package Relaxsd\ICalendar
 */
class RecurrenceDate
{
    // TODO: Maybe combine HasValueDataType and HasRecurrenceDateValues and move the static factory methods there
    use HasTimeZoneIdentifier,
        HasXParams,
        // HasValueDataType is included in HasRecurrenceDateValues
        HasRecurrenceDateValues;

    const DEFAULT_VALUE_TYPE = ValueDataType::VALUETYPE_DATE_TIME;

    /**
     * @param DateTime[]|DateTime $dates
     *
     * @return \Relaxsd\ICalendar\Properties\Recurrence\RecurrenceDate
     */
    public static function forDate($dates)
    {
        /** @var DateTime[] $dates */
        $dates = is_array($dates) ? $dates : func_get_args();

        return (new self())->addRecurrenceDates(RecurrenceDateValue::forDateTimes($dates), ValueDataType::VALUETYPE_DATE);
    }

    /**
     * @param DateTime[]|DateTime $dates
     *
     * @return \Relaxsd\ICalendar\Properties\Recurrence\RecurrenceDate
     */
    public static function forDateTime($dates)
    {
        /** @var DateTime[] $dates */
        $dates = is_array($dates) ? $dates : func_get_args();

        return (new self())->addRecurrenceDates(RecurrenceDateValue::forDateTimes($dates), ValueDataType::VALUETYPE_DATE_TIME);
    }

    /**
     * @param Period[]|Period $periods
     *
     * @return \Relaxsd\ICalendar\Properties\Recurrence\RecurrenceDate
     */
    public static function forPeriod($periods)
    {
        /** @var Period[] $dates */
        $periods = is_array($periods) ? $periods : func_get_args();

        return (new self())->addRecurrenceDates(RecurrenceDateValue::forPeriods($periods), ValueDataType::VALUETYPE_PERIOD);
    }

}
