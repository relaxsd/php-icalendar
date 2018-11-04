<?php

namespace Relaxsd\ICalendar\Properties\Calendar;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasIanaTokenValue;

/**
 * Class Method
 *
 * 4.7.2 Method
 *
 * Property Name: METHOD
 *
 * Purpose: This property defines the iCalendar object method associated
 * with the calendar object.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: The property can be specified in an iCalendar object.
 *
 * Description: When used in a MIME message entity, the value of this
 * property MUST be the same as the Content-Type "method" parameter
 * value. This property can only appear once within the iCalendar
 * object. If either the "METHOD" property or the Content-Type "method"
 * parameter is specified, then the other MUST also be specified.
 *
 * No methods are defined by this specification. This is the subject of
 * other specifications, such as the iCalendar Transport-independent
 * Interoperability Protocol (iTIP) defined by [ITIP].
 *
 * If this property is not present in the iCalendar object, then a
 * scheduling transaction MUST NOT be assumed. In such cases, the
 * iCalendar object is merely being used to transport a snapshot of some
 * calendar information; without the intention of conveying a scheduling
 * semantic.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * method     = "METHOD" metparam ":" metvalue CRLF
 *
 * metparam   = *(";" xparam)
 *
 * metvalue   = iana-token
 *
 * Example: The following is a hypothetical example of this property to
 * convey that the iCalendar object is a request for a meeting:
 *
 * METHOD:REQUEST
 *
 * @package Relaxsd\ICalendar\Properties\Calendar\Traits
 */
class Method
{

    // From iTIP standard: https://www.ietf.org/rfc/rfc2446.txt

    /**
     * PUBLISH:
     *   - Event:    Post notification of an event. Used primarily as a method of advertising the existence of an event.
     *   - FreeBusy: Publish unsolicited busy time data.
     *   - Journal:  Post a journal entry. Used primarily as a method of advertising the existence of a journal entry.
     *   - To do:    Post notification of a VTODO. Used primarily as a method of advertising the existence of a VTODO.
     */
    const PUBLISH = 'PUBLISH';
    /**
     * REQUEST:
     *   - Event:    Make a request for an event. This is an explicit invitation to one or more "Attendees". Event Requests are also used to update or change an existing event. Clients that cannot handle REQUEST may degrade the event to view it as an PUBLISH.
     *   - FreeBusy: Request busy time data.
     *   - To do:    Assign a VTODO. This is an explicit assignment to one or more Calendar Users. The REQUEST method is also used to update or change an existing VTODO. Clients that cannot handle REQUEST MAY degrade the method to treat it as a PUBLISH.
     */
    const REQUEST = 'REQUEST';
    /**
     * REPLY:
     *   - Event:    Reply to an event request. Clients may set their status ("partstat") to ACCEPTED, DECLINED, TENTATIVE, or DELEGATED.
     *   - FreeBusy: Reply to a busy time request.
     *   - To do:    Reply to a VTODO request. Attendees MAY set PARTSTAT to ACCEPTED, DECLINED, TENTATIVE, DELEGATED, PARTIAL, and COMPLETED.
     */
    const REPLY = 'REPLY';
    /**
     * ADD:
     *   - Event:    Add one or more instances to an existing event.
     *   - Journal:  Add one or more instances to an existing journal entry.
     *   - To do:    Add one or more instances to an existing to-do.
     */
    const ADD = 'ADD';
    /**
     * CANCEL:
     *   - Event:    Cancel one or more instances of an existing event.
     *   - Journal:  Cancel one or more instances of an existing journal entry.
     *   - To do:    Cancel one or more instances of an existing to-do.
     */
    const CANCEL = 'CANCEL';
    /**
     * REFRESH:
     *   - Event:    A request is sent to an "Organizer" by an "Attendee" asking for the latest version of an event to be resent to the requester.
     *   - To do:    A request sent to a VTODO Organizer asking for the latest version of a VTODO.
     */
    const REFRESH = 'REFRESH';
    /**
     * COUNTER:
     *   - Event:    Counter a REQUEST with an alternative proposal, Sent by an "Attendee" to the "Organizer".
     *   - To do:    Counter a REQUEST with an alternative proposal.
     */
    const COUNTER = 'COUNTER';
    /**
     * DECLINECOUNTER:
     *   - Event:    Decline a counter proposal. Sent to an "Attendee" by the "Organizer".
     *   - To do:    Decline a counter proposal by an Attendee.
     */
    const DECLINE_COUNTER = 'DECLINECOUNTER';

    use HasXParams,
        HasIanaTokenValue;

    /**
     * Method constructor.
     *
     * @param string $method
     */
    public function __construct($method)
    {
        $this->setIanaToken($method);
    }

}
