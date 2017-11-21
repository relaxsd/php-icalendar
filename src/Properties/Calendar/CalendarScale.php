<?php

namespace Relaxsd\ICalendar\Properties\Calendar;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasIanaTokenValue;

/**
 * Class CalendarScale
 *
 * 4.7.1 Calendar Scale
 *
 * Property Name: CALSCALE
 *
 * Purpose: This property defines the calendar scale used for the
 * calendar information specified in the iCalendar object.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: Property can be specified in an iCalendar object. The
 * default value is "GREGORIAN".
 *
 * Description: This memo is based on the Gregorian calendar scale. The
 * Gregorian calendar scale is assumed if this property is not specified
 * in the iCalendar object. It is expected that other calendar scales
 * will be defined in other specifications or by future versions of this
 * memo.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * calscale   = "CALSCALE" calparam ":" calvalue CRLF
 *
 * calparam   = *(";" xparam)
 *
 * calvalue   = "GREGORIAN" / iana-token
 *
 * Example: The following is an example of this property:
 *
 * CALSCALE:GREGORIAN
 *
 * @package Relaxsd\ICalendar\Traits
 */
class CalendarScale
{
    use HasXParams,
        HasIanaTokenValue;

    const CALSCALE_GREGORIAN = 'GREGORIAN';

    /**
     * CalendarScale constructor.
     *
     * @param string $calendarScale
     */
    public function __construct($calendarScale = self::CALSCALE_GREGORIAN)
    {
        $this->setIanaToken($calendarScale);
    }

}
