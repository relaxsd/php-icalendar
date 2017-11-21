<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasCalendarUserAddressesValue;

/**
 * Class GroupOrListMembership
 *
 * 4.2.11  Group or List Membership
 *
 * Parameter Name: MEMBER
 *
 * Purpose: To specify the group or list membership of the calendar user
 * specified by the property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * memberparam        = "MEMBER" "=" DQUOTE cal-address DQUOTE
 *("," DQUOTE cal-address DQUOTE)
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. The parameter identifies the groups or list
 * membership for the calendar user specified by the property. The
 * parameter value either a single calendar address in a quoted-string
 * or a COMMA character (US-ASCII decimal 44) list of calendar
 * addresses, each in a quoted-string. The individual calendar address
 * parameter values MUST each be specified in a quoted-string.
 *
 * Example:
 *
 * ATTENDEE;MEMBER="MAILTO:ietf-calsch@imc.org":MAILTO:jsmith@host.com
 *
 * ATTENDEE;MEMBER="MAILTO:projectA@host.com","MAILTO:projectB@host.
 * com":MAILTO:janedoe@host.com
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class GroupOrListMembership
{
    use HasCalendarUserAddressesValue;

    /**
     * GroupOrListMembership constructor.
     *
     * @param string[]|string $calendarAddresses
     */
    public function __construct($calendarAddresses)
    {
        $this->addCalendarUserAddresses((array)$calendarAddresses);
    }

}
