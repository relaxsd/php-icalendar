<?php

namespace Relaxsd\ICalendar\Properties\Relationship;

use Relaxsd\ICalendar\Parameters\Traits\HasCommonName;
use Relaxsd\ICalendar\Parameters\Traits\HasDirectoryEntryReference;
use Relaxsd\ICalendar\Parameters\Traits\HasLanguage;
use Relaxsd\ICalendar\Parameters\Traits\HasSentBy;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasCalendarUserAddressValue;

/**
 * Class Organizer
 *
 * 4.8.4.3 Organizer
 *
 * Property Name: ORGANIZER
 *
 * Purpose: The property defines the organizer for a calendar component.
 *
 * Value Type: CAL-ADDRESS
 *
 * Property Parameters: Non-standard, language, common name, directory
 * entry reference, sent by property parameters can be specified on this
 * property.
 *
 * Conformance: This property MUST be specified in an iCalendar object
 * that specifies a group scheduled calendar entity. This property MUST
 * be specified in an iCalendar object that specifies the publication of
 * a calendar user's busy time. This property MUST NOT be specified in
 * an iCalendar object that specifies only a time zone definition or
 * that defines calendar entities that are not group scheduled entities,
 * but are entities only on a single user's calendar.
 *
 * Description: The property is specified within the "VEVENT", "VTODO",
 * "VJOURNAL calendar components to specify the organizer of a group
 * scheduled calendar entity. The property is specified within the
 * "VFREEBUSY" calendar component to specify the calendar user
 * requesting the free or busy time. When publishing a "VFREEBUSY"
 * calendar component, the property is used to specify the calendar that
 * the published busy time came from.
 *
 * The property has the property parameters CN, for specifying the
 * common or display name associated with the "Organizer", DIR, for
 * specifying a pointer to the directory information associated with the
 * "Organizer", SENT-BY, for specifying another calendar user that is
 * acting on behalf of the "Organizer". The non-standard parameters may
 * also be specified on this property. If the LANGUAGE property
 * parameter is specified, the identified language applies to the CN
 * parameter value.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * organizer  = "ORGANIZER" orgparam ":"
 * cal-address CRLF
 *
 * orgparam   = *(
 *
 * ; the following are optional,
 * ; but MUST NOT occur more than once
 *
 * (";" cnparam) / (";" dirparam) / (";" sentbyparam) /
 * (";" languageparam) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 * (";" xparam)
 *
 * )
 *
 * Example: The following is an example of this property:
 *
 * ORGANIZER;CN=John Smith:MAILTO:jsmith@host1.com
 *
 * The following is an example of this property with a pointer to the
 * directory information associated with the organizer:
 *
 * ORGANIZER;CN=JohnSmith;DIR="ldap://host.com:6666/o=3DDC%20Associ
 * ates,c=3DUS??(cn=3DJohn%20Smith)":MAILTO:jsmith@host1.com
 *
 * The following is an example of this property used by another calendar
 * user who is acting on behalf of the organizer, with responses
 * intended to be sent back to the organizer, not the other calendar
 * user:
 *
 * ORGANIZER;SENT-BY="MAILTO:jane_doe@host.com":
 * MAILTO:jsmith@host1.com
 *
 * @package Relaxsd\ICalendar
 */
class Organizer
{

    // Parameters
    use HasCommonName,
        HasDirectoryEntryReference,
        HasSentBy,
        HasLanguage,
        HasXParams,
        HasCalendarUserAddressValue;

    /**
     * Organizer constructor.
     *
     * @param string $calendarUserAddress
     * @param bool $mailTo
     */
    public function __construct($calendarUserAddress = null, $mailTo = false)
    {
        if (isset($calendarUserAddress)) {
            $this->setCalendarUserAddress($calendarUserAddress, $mailTo);
        }
    }

    public static function forEmail($eMailAddress)
    {
        return new self($eMailAddress, true);
    }
}
