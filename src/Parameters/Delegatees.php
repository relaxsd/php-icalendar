<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasCalendarUserAddressesValue;

/**
 * Class Delegatees
 *
 * 4.2.5 Delegatees
 *
 * Parameter Name: DELEGATED-TO
 *
 * Purpose: To specify the calendar users to whom the calendar user
 * specified by the property has delegated participation.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * deltoparam = "DELEGATED-TO" "=" DQUOTE cal-address DQUOTE
 *("," DQUOTE cal-address DQUOTE)
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. This parameter specifies those calendar users
 * whom have been delegated participation in a group scheduled event or
 * to-do by the calendar user specified by the property. The value MUST
 * be a MAILTO URI as defined in [RFC 1738]. The individual calendar
 * address parameter values MUST each be specified in a quoted-string.
 *
 * Example:
 *
 * ATTENDEE;DELEGATED-TO="MAILTO:jdoe@host.com","MAILTO:jqpublic@
 * host.com":MAILTO:jsmith@host.com
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class Delegatees
{
    use HasCalendarUserAddressesValue;

    /**
     * Delegatees constructor.
     *
     * @param string[] $calendarUserAddresses
     */
    public function __construct(array $calendarUserAddresses)
    {
        $this->addCalendarUserAddresses($calendarUserAddresses);
    }

}
