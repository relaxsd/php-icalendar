<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasCalendarUserAddressesValue;

/**
 * Class Delegators
 *
 * 4.2.4 Delegators
 *
 * Parameter Name: DELEGATED-FROM
 *
 * Purpose: To specify the calendar users that have delegated their
 * participation to the calendar user specified by the property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * delfromparam       = "DELEGATED-FROM" "=" DQUOTE cal-address DQUOTE
 *("," DQUOTE cal-address DQUOTE)
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. This parameter can be specified on a property
 * that has a value type of calendar address. This parameter specifies
 * those calendar uses that have delegated their participation in a
 * group scheduled event or to-do to the calendar user specified by the
 * property. The value MUST be a MAILTO URI as defined in [RFC 1738].
 * The individual calendar address parameter values MUST each be
 * specified in a quoted-string.
 *
 * Example:
 * ATTENDEE;DELEGATED-FROM="MAILTO:jsmith@host.com":MAILTO:
 * jdoe@host.com
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class Delegators
{
    use HasCalendarUserAddressesValue;

    /**
     * Delegators constructor.
     *
     * @param string[] $calendarUserAddresses
     */
    public function __construct(array $calendarUserAddresses)
    {
        $this->addCalendarUserAddresses($calendarUserAddresses);
    }

}
