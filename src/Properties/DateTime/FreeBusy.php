<?php

namespace Relaxsd\ICalendar\Properties\DateTime;

use Relaxsd\ICalendar\Parameters\Traits\HasFreeBusyType;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\Period;
use Relaxsd\ICalendar\Values\Traits\HasPeriodValues;

/**
 * Class FreeBusy
 *
 * 4.8.2.6 Free/Busy Time
 *
 * Property Name: FREEBUSY
 *
 * Purpose: The property defines one or more free or busy time
 * intervals.
 *
 * Value Type: PERIOD. The date and time values MUST be in an UTC time
 * format.
 *
 * Property Parameters: Non-standard or free/busy time type property
 * parameters can be specified on this property.
 *
 * Conformance: The property can be specified in a "VFREEBUSY" calendar
 * component.
 *
 * Property Parameter: "FBTYPE" and non-standard parameters can be
 * specified on this property.
 *
 * Description: These time periods can be specified as either a start
 * and end date-time or a start date-time and duration. The date and
 * time MUST be a UTC time format.
 *
 * "FREEBUSY" properties within the "VFREEBUSY" calendar component
 * SHOULD be sorted in ascending order, based on start time and then end
 * time, with the earliest periods first.
 *
 * The "FREEBUSY" property can specify more than one value, separated by
 * the COMMA character (US-ASCII decimal 44). In such cases, the
 * "FREEBUSY" property values SHOULD all be of the same "FBTYPE"
 * property parameter type (e.g., all values of a particular "FBTYPE"
 * listed together in a single property).
 *
 * Format Definition: The property is defined by the following notation:
 *
 * freebusy   = "FREEBUSY" fbparam ":" fbvalue
 * CRLF
 *
 * fbparam    = *(
 * ; the following is optional,
 * ; but MUST NOT occur more than once
 *
 * (";" fbtypeparam) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 * (";" xparam)
 *
 * )
 *
 * fbvalue    = period *["," period]
 * ;Time value MUST be in the UTC time format.
 *
 * Example: The following are some examples of this property:
 *
 * FREEBUSY;FBTYPE=BUSY-UNAVAILABLE:19970308T160000Z/PT8H30M
 *
 * FREEBUSY;FBTYPE=FREE:19970308T160000Z/PT3H,19970308T200000Z/PT1H
 *
 * FREEBUSY;FBTYPE=FREE:19970308T160000Z/PT3H,19970308T200000Z/PT1H,
 * 19970308T230000Z/19970309T000000Z
 */
class FreeBusy
{
    use HasFreeBusyType,
        HasXParams,
        // Included in HasPeriodValues
        //HasValueDataType,
        HasPeriodValues;

    const DEFAULT_VALUE_TYPE = ValueDataType::VALUETYPE_PERIOD;

    /**
     * FreeBusy constructor.
     *
     * @param Period[]|Period|null $periods
     */
    public function __construct($periods = null)
    {
        if (isset($periods)) {
            $this->addPeriods(is_array($periods) ? $periods : [$periods]);
        }
    }

}
