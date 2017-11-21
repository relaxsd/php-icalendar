<?php

namespace Relaxsd\ICalendar\Components;

use Relaxsd\ICalendar\Components\Traits\HasAlarms;
use Relaxsd\ICalendar\Contracts\Writable;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Properties\ChangeManagement\Traits\HasDateTimeCreated;
use Relaxsd\ICalendar\Properties\ChangeManagement\Traits\HasDateTimeStamp;
use Relaxsd\ICalendar\Properties\ChangeManagement\Traits\HasLastModified;
use Relaxsd\ICalendar\Properties\ChangeManagement\Traits\HasSequenceNumber;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDateTimeEnd;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDateTimeStart;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDuration;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasTimeTransparency;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasAttachments;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasCategoriesProperty;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasClassificationProperty;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasComments;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasDescription;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasGeographicPosition;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasLocation;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasPriority;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasResourcesProperty;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasStatus;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasSummary;
use Relaxsd\ICalendar\Properties\Misc\Traits\HasRequestStatuses;
use Relaxsd\ICalendar\Properties\Misc\Traits\HasXProperties;
use Relaxsd\ICalendar\Properties\Recurrence\Traits\HasExceptionDateProperties;
use Relaxsd\ICalendar\Properties\Recurrence\Traits\HasExceptionRuleProperties;
use Relaxsd\ICalendar\Properties\Recurrence\Traits\HasRecurrenceDateProperties;
use Relaxsd\ICalendar\Properties\Recurrence\Traits\HasRecurrenceRuleProperties;
use Relaxsd\ICalendar\Properties\Relationship\Traits\HasAttendees;
use Relaxsd\ICalendar\Properties\Relationship\Traits\HasContacts;
use Relaxsd\ICalendar\Properties\Relationship\Traits\HasOrganizer;
use Relaxsd\ICalendar\Properties\Relationship\Traits\HasRecurrenceId;
use Relaxsd\ICalendar\Properties\Relationship\Traits\HasRelatedToProperties;
use Relaxsd\ICalendar\Properties\Relationship\Traits\HasUniqueIdentifier;
use Relaxsd\ICalendar\Properties\Relationship\Traits\HasUrl;

/**
 * Class Event
 *
 * 4.6.1 Event Component
 *
 * Component Name: "VEVENT"
 *
 * Purpose: Provide a grouping of component properties that describe an
 * event.
 *
 * Format Definition: A "VEVENT" calendar component is defined by the
 * following notation:
 *
 * eventc     = "BEGIN" ":" "VEVENT" CRLF
 * eventprop *alarmc
 * "END" ":" "VEVENT" CRLF
 *
 * eventprop  = *(
 *
 * ; the following are optional,
 * ; but MUST NOT occur more than once
 *
 * class / created / description / dtstart / geo /
 *
 *
 *
 * Dawson & Stenerson          Standards Track                    [Page 52]
 *
 * RFC 2445                       iCalendar                   November 1998
 *
 *
 * last-mod / location / organizer / priority /
 * dtstamp / seq / status / summary / transp /
 * uid / url / recurid /
 *
 * ; either 'dtend' or 'duration' may appear in
 * ; a 'eventprop', but 'dtend' and 'duration'
 * ; MUST NOT occur in the same 'eventprop'
 *
 * dtend / duration /
 *
 * ; the following are optional,
 * ; and MAY occur more than once
 *
 * attach / attendee / categories / comment /
 * contact / exdate / exrule / rstatus / related /
 * resources / rdate / rrule / x-prop
 *
 * )
 *
 * Description: A "VEVENT" calendar component is a grouping of component
 * properties, and possibly including "VALARM" calendar components, that
 * represents a scheduled amount of time on a calendar. For example, it
 * can be an activity; such as a one-hour long, department meeting from
 * 8:00 AM to 9:00 AM, tomorrow. Generally, an event will take up time
 * on an individual calendar. Hence, the event will appear as an opaque
 * interval in a search for busy time. Alternately, the event can have
 * its Time Transparency set to "TRANSPARENT" in order to prevent
 * blocking of the event in searches for busy time.
 *
 * The "VEVENT" is also the calendar component used to specify an
 * anniversary or daily reminder within a calendar. These events have a
 * DATE value type for the "DTSTART" property instead of the default
 * data type of DATE-TIME. If such a "VEVENT" has a "DTEND" property, it
 * MUST be specified as a DATE value also. The anniversary type of
 * "VEVENT" can span more than one date (i.e, "DTEND" property value is
 * set to a calendar date after the "DTSTART" property value).
 *
 * The "DTSTART" property for a "VEVENT" specifies the inclusive start
 * of the event. For recurring events, it also specifies the very first
 * instance in the recurrence set. The "DTEND" property for a "VEVENT"
 * calendar component specifies the non-inclusive end of the event. For
 * cases where a "VEVENT" calendar component specifies a "DTSTART"
 * property with a DATE data type but no "DTEND" property, the events
 * non-inclusive end is the end of the calendar date specified by the
 * "DTSTART" property. For cases where a "VEVENT" calendar component
 * specifies a "DTSTART" property with a DATE-TIME data type but no
 * "DTEND" property, the event ends on the same calendar date and time
 * of day specified by the "DTSTART" property.
 *
 * The "VEVENT" calendar component cannot be nested within another
 * calendar component. However, "VEVENT" calendar components can be
 * related to each other or to a "VTODO" or to a "VJOURNAL" calendar
 * component with the "RELATED-TO" property.
 *
 * Example: The following is an example of the "VEVENT" calendar
 * component used to represent a meeting that will also be opaque to
 * searches for busy time:
 *
 * BEGIN:VEVENT
 * UID:19970901T130000Z-123401@host.com
 * DTSTAMP:19970901T1300Z
 * DTSTART:19970903T163000Z
 * DTEND:19970903T190000Z
 * SUMMARY:Annual Employee Review
 * CLASS:PRIVATE
 * CATEGORIES:BUSINESS,HUMAN RESOURCES
 * END:VEVENT
 *
 * The following is an example of the "VEVENT" calendar component used
 * to represent a reminder that will not be opaque, but rather
 * transparent, to searches for busy time:
 *
 * BEGIN:VEVENT
 * UID:19970901T130000Z-123402@host.com
 * DTSTAMP:19970901T1300Z
 * DTSTART:19970401T163000Z
 * DTEND:19970402T010000Z
 * SUMMARY:Laurel is in sensitivity awareness class.
 * CLASS:PUBLIC
 * CATEGORIES:BUSINESS,HUMAN RESOURCES
 * TRANSP:TRANSPARENT
 * END:VEVENT
 *
 * The following is an example of the "VEVENT" calendar component used
 * to represent an anniversary that will occur annually. Since it takes
 * up no time, it will not appear as opaque in a search for busy time;
 * no matter what the value of the "TRANSP" property indicates:
 *
 * BEGIN:VEVENT
 * UID:19970901T130000Z-123403@host.com
 * DTSTAMP:19970901T1300Z
 * DTSTART:19971102
 * SUMMARY:Our Blissful Anniversary
 * CLASS:CONFIDENTIAL
 * CATEGORIES:ANNIVERSARY,PERSONAL,SPECIAL OCCASION
 * RRULE:FREQ=YEARLY
 * END:VEVENT
 *
 * @package Relaxsd\ICalendar
 */
class Event implements Writable
{

    // Properties
    use
        HasClassificationProperty,
        HasDateTimeCreated,
        HasDescription,
        HasDateTimeStart,
        HasGeographicPosition,
        HasLastModified,
        HasLocation,
        HasOrganizer,
        HasPriority,
        HasDateTimeStamp,
        HasSequenceNumber,
        HasStatus,
        HasSummary,
        HasTimeTransparency,
        HasUniqueIdentifier,
        HasUrl,
        HasRecurrenceId;

    // Either 'dtend' or 'duration' may appear in a 'eventprop',
    // but 'dtend' and 'duration' MUST NOT occur in the same 'eventprop'
    use HasDateTimeEnd,
        HasDuration;

    // The following are optional and MAY occur more than once
    use HasAttachments,
        HasAttendees,
        HasCategoriesProperty,
        HasComments,
        HasContacts,
        HasExceptionDateProperties,
        HasExceptionRuleProperties,
        HasRequestStatuses,
        HasRelatedToProperties,
        HasResourcesProperty,
        HasRecurrenceDateProperties,
        HasRecurrenceRuleProperties,
        HasXProperties;

    // Children
    use HasAlarms;

    /**
     * Event constructor.
     *
     * @param string $uid
     */
    public function __construct($uid)
    {
        $this->setUniqueIdentifier($uid);
    }

    /**
     * @param \Relaxsd\ICalendar\Contracts\Writer $writer
     */
    function acceptWriter(Writer $writer)
    {
        $writer->writeEvent($this);
    }

}
