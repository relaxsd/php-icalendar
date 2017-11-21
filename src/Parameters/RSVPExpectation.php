<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasBooleanValue;

/**
 * Class RSVPExpectation
 *
 * 4.2.17  RSVP Expectation
 *
 * Parameter Name: RSVP
 *
 * Purpose: To specify whether there is an expectation of a favor of a
 * reply from the calendar user specified by the property value.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * rsvpparam = "RSVP" "=" ("TRUE" / "FALSE")
 * ; Default is FALSE
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. The parameter identifies the expectation of a
 * reply from the calendar user specified by the property value. This
 * parameter is used by the "Organizer" to request a participation
 * status reply from an "Attendee" of a group scheduled event or to-do.
 * If not specified on a property that allows this parameter, the
 * default value is FALSE.
 *
 * Example:
 *
 * ATTENDEE;RSVP=TRUE:MAILTO:jsmith@host.com
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class RSVPExpectation
{
    use HasBooleanValue;

    /**
     * RSVPExpectation constructor.
     *
     * @param bool $rsvpExpectation
     */
    public function __construct($rsvpExpectation)
    {
        $this->setValue($rsvpExpectation);
    }

}
