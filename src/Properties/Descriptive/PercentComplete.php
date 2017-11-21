<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasIntegerValue;

/**
 * Class PercentComplete
 *
 * 4.8.1.8 Percent Complete
 *
 * Property Name: PERCENT-COMPLETE
 *
 * Purpose: This property is used by an assignee or delegatee of a to-do
 * to convey the percent completion of a to-do to the Organizer.
 *
 * Value Type: INTEGER
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: This property can be specified in a "VTODO" calendar
 * component.
 *
 * Description: The property value is a positive integer between zero
 * and one hundred. A value of "0" indicates the to-do has not yet been
 * started. A value of "100" indicates that the to-do has been
 * completed. Integer values in between indicate the percent partially
 * complete.
 *
 * When a to-do is assigned to multiple individuals, the property value
 * indicates the percent complete for that portion of the to-do assigned
 * to the assignee or delegatee. For example, if a to-do is assigned to
 * both individuals "A" and "B". A reply from "A" with a percent
 * complete of "70" indicates that "A" has completed 70% of the to-do
 * assigned to them. A reply from "B" with a percent complete of "50"
 * indicates "B" has completed 50% of the to-do assigned to them.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * percent = "PERCENT-COMPLETE" pctparam ":" integer CRLF
 *
 * pctparam   = *(";" xparam)
 *
 * Example: The following is an example of this property to show 39%
 * completion:
 *
 * PERCENT-COMPLETE:39
 *
 * @package Relaxsd\ICalendar\Properties\Descriptive
 */
class PercentComplete
{

    use HasXParams,
        HasIntegerValue;

    /**
     * PercentComplete constructor.
     *
     * @param integer $complete
     */
    public function __construct($complete = null)
    {
        $this->setValue($complete);
    }

}
