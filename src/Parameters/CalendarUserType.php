<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class CalendarUserType
 *
 * 4.2.3 Calendar User Type
 *
 * Parameter Name: CUTYPE
 *
 * Purpose: To specify the type of calendar user specified by the
 * property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * cutypeparam        = "CUTYPE" "="
 * ("INDIVIDUAL"          ; An individual
 * / "GROUP"               ; A group of individuals
 * / "RESOURCE"            ; A physical resource
 * / "ROOM"                ; A room resource
 * / "UNKNOWN"             ; Otherwise not known
 * / x-name                ; Experimental type
 * / iana-token)           ; Other IANA registered
 * ; type
 * ; Default is INDIVIDUAL
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. The parameter identifies the type of calendar
 * user specified by the property. If not specified on a property that
 * allows this parameter, the default is INDIVIDUAL.
 *
 * Example:
 *
 * ATTENDEE;CUTYPE=GROUP:MAILTO:ietf-calsch@imc.org
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class CalendarUserType
{
    use HasValue;

    // 4.2.3 Calendar User Type
    const CUTYPE_INDIVIDUAL = 'INDIVIDUAL';
    const CUTYPE_GROUP = 'GROUP';
    const CUTYPE_RESOURCE = 'RESOURCE';
    const CUTYPE_ROOM = 'ROOM';
    const CUTYPE_UNKNOWN = 'UNKNOWN';
    // x-name                ; Experimental type
    // iana-token)           ; Other IANA registered type

    /**
     * CalendarUserType constructor.
     *
     * @param string $calendarUserType
     */
    public function __construct($calendarUserType = self::CUTYPE_INDIVIDUAL)
    {
        $this->setValue($calendarUserType);
    }

}
