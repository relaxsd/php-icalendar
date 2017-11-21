<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class ParticipationRole
 *
 * 4.2.16 Participation Role
 *
 * Parameter Name: ROLE
 *
 * Purpose: To specify the participation role for the calendar user
 * specified by the property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * roleparam  = "ROLE" "="
 * ("CHAIR"               ; Indicates chair of the
 * ; calendar entity
 * / "REQ-PARTICIPANT"     ; Indicates a participant whose
 * ; participation is required
 * / "OPT-PARTICIPANT"     ; Indicates a participant whose
 * ; participation is optional
 * / "NON-PARTICIPANT"     ; Indicates a participant who is
 * ; copied for information
 * ; purposes only
 * / x-name                ; Experimental role
 * / iana-token)           ; Other IANA role
 * ; Default is REQ-PARTICIPANT
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. The parameter specifies the participation
 * role for the calendar user specified by the property in the group
 * schedule calendar component. If not specified on a property that
 * allows this parameter, the default value is REQ-PARTICIPANT.
 *
 * Example:
 *
 * ATTENDEE;ROLE=CHAIR:MAILTO:mrbig@host.com
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class ParticipationRole
{
    use HasValue;

    // Indicates chair of the calendar entity
    const ROLE_CHAIR = 'CHAIR';
    // Indicates a participant whose participation is required
    const ROLE_REQ_PARTICIPANT = 'REQ-PARTICIPANT';
    // Indicates a participant whose participation is optional
    const ROLE_OPT_PARTICIPAN = 'OPT-PARTICIPAN';
    // Indicates a participant who is copied for information purposes only
    const ROLE_NON_PARTICIPANT = 'NON-PARTICIPANT';

    /**
     * ParticipationRole constructor.
     *
     * @param string $participationRole
     */
    public function __construct($participationRole)
    {
        $this->setValue($participationRole);
    }

}
