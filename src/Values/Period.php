<?php

namespace Relaxsd\ICalendar\Values;

use DateTime;
use Relaxsd\ICalendar\Values\Traits\HasStartDateTimeValue;

/**
 * Class Period
 *
 * 4.3.9 Period of Time
 *
 * Value Name: PERIOD
 *
 * Purpose: This value type is used to identify values that contain a
 * precise period of time.
 *
 * Formal Definition: The data type is defined by the following
 * notation:
 *
 * period     = period-explicit / period-start
 *
 * period-explicit = date-time "/" date-time
 * ; [ISO 8601] complete representation basic format for a period of
 * ; time consisting of a start and end. The start MUST be before the
 * ; end.
 *
 * period-start = date-time "/" dur-value
 * ; [ISO 8601] complete representation basic format for a period of
 * ; time consisting of a start and positive duration of time.
 *
 * Description: If the property permits, multiple "period" values are
 * specified by a COMMA character (US-ASCII decimal 44) separated list
 * of values. There are two forms of a period of time. First, a period
 * of time is identified by its start and its end. This format is
 * expressed as the [ISO 8601] complete representation, basic format for
 * "DATE-TIME" start of the period, followed by a SOLIDUS character
 * (US-ASCII decimal 47), followed by the "DATE-TIME" of the end of the
 * period. The start of the period MUST be before the end of the period.
 * Second, a period of time can also be defined by a start and a
 * positive duration of time. The format is expressed as the [ISO 8601]
 * complete representation, basic format for the "DATE-TIME" start of
 * the period, followed by a SOLIDUS character (US-ASCII decimal 47),
 * followed by the [ISO 8601] basic format for "DURATION" of the period.
 *
 * Example: The period starting at 18:00:00 UTC, on January 1, 1997 and
 * ending at 07:00:00 UTC on January 2, 1997 would be:
 *
 * 19970101T180000Z/19970102T070000Z
 *
 * The period start at 18:00:00 on January 1, 1997 and lasting 5 hours
 * and 30 minutes would be:
 *
 * 19970101T180000Z/PT5H30M
 *
 * No additional content value encoding (i.e., BACKSLASH character
 * encoding) is defined for this value type.
 *
 * @package Relaxsd\ICalendar\Values\Traits
 */
abstract class Period
{
    use HasStartDateTimeValue;

    /**
     * Period constructor.
     *
     * @param DateTime|string|null $startDate
     */
    public function __construct($startDate = null)
    {
        if (isset($startDate)) {
            $this->setStartDate($startDate);
        }
    }

}
