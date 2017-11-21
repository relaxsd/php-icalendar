<?php

namespace Relaxsd\ICalendar\Components;

use Relaxsd\ICalendar\Contracts\Writable;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Properties\ChangeManagement\Traits\HasDateTimeCreated;
use Relaxsd\ICalendar\Properties\ChangeManagement\Traits\HasDateTimeStamp;
use Relaxsd\ICalendar\Properties\ChangeManagement\Traits\HasLastModified;
use Relaxsd\ICalendar\Properties\ChangeManagement\Traits\HasSequenceNumber;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDateTimeCompleted;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDateTimeDue;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDateTimeStart;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDuration;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasAttachments;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasCategoriesProperty;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasClassificationProperty;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasComments;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasDescription;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasGeographicPosition;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasLocation;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasPercentComplete;
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
 * Class Todo
 *
 * 4.6.2 To-do Component
 *
 * Component Name: VTODO
 *
 * Purpose: Provide a grouping of calendar properties that describe a
 * to-do.
 *
 * Formal Definition: A "VTODO" calendar component is defined by the
 * following notation:
 *
 * todoc      = "BEGIN" ":" "VTODO" CRLF
 * todoprop *alarmc
 * "END" ":" "VTODO" CRLF
 *
 * todoprop   = *(
 *
 * ; the following are optional,
 * ; but MUST NOT occur more than once
 *
 * class / completed / created / description / dtstamp /
 * dtstart / geo / last-mod / location / organizer /
 * percent / priority / recurid / seq / status /
 * summary / uid / url /
 *
 * ; either 'due' or 'duration' may appear in
 * ; a 'todoprop', but 'due' and 'duration'
 * ; MUST NOT occur in the same 'todoprop'
 *
 * due / duration /
 *
 * ; the following are optional,
 * ; and MAY occur more than once
 * attach / attendee / categories / comment / contact /
 * exdate / exrule / rstatus / related / resources /
 * rdate / rrule / x-prop
 *
 * )
 *
 * Description: A "VTODO" calendar component is a grouping of component
 * properties and possibly "VALARM" calendar components that represent
 * an action-item or assignment. For example, it can be used to
 * represent an item of work assigned to an individual; such as "turn in
 * travel expense today".
 *
 * The "VTODO" calendar component cannot be nested within another
 * calendar component. However, "VTODO" calendar components can be
 * related to each other or to a "VTODO" or to a "VJOURNAL" calendar
 * component with the "RELATED-TO" property.
 *
 * A "VTODO" calendar component without the "DTSTART" and "DUE" (or
 * "DURATION") properties specifies a to-do that will be associated with
 * each successive calendar date, until it is completed.
 *
 * Example: The following is an example of a "VTODO" calendar component:
 *
 * BEGIN:VTODO
 * UID:19970901T130000Z-123404@host.com
 * DTSTAMP:19970901T1300Z
 * DTSTART:19970415T133000Z
 * DUE:19970416T045959Z
 * SUMMARY:1996 Income Tax Preparation
 * CLASS:CONFIDENTIAL
 * CATEGORIES:FAMILY,FINANCE
 * PRIORITY:1
 * STATUS:NEEDS-ACTION
 * END:VTODO
 *
 * @package Relaxsd\ICalendar\Components\
 */
class Todo implements Writable
{

    use HasClassificationProperty,
        HasDateTimeCompleted,
        HasDateTimeCreated,
        HasDescription,
        HasDateTimeStamp,
        HasDateTimeStart,
        HasGeographicPosition,
        HasLastModified,
        HasLocation,
        HasOrganizer,
        HasPercentComplete,
        HasPriority,
        HasRecurrenceId,
        HasSequenceNumber,
        HasStatus,
        HasSummary,
        HasUniqueIdentifier,
        HasUrl;

    // either 'due' or 'duration' may appear in
    // a 'todoprop', but 'due' and 'duration'
    // MUST NOT occur in the same 'todoprop'
    use HasDateTimeDue,
        HasDuration;

    // the following are optional,
    // and MAY occur more than once
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

    /**
     * @param \Relaxsd\ICalendar\Contracts\Writer $writer
     */
    function acceptWriter(Writer $writer)
    {
        $writer->writeTodo($this);
    }

}
