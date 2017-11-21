<?php

namespace Relaxsd\ICalendar\Components;

use Relaxsd\ICalendar\Components\Traits\HasEvents;
use Relaxsd\ICalendar\Components\Traits\HasExperimentalComponents;
use Relaxsd\ICalendar\Components\Traits\HasFreeBusies;
use Relaxsd\ICalendar\Components\Traits\HasIanaComponents;
use Relaxsd\ICalendar\Components\Traits\HasJournals;
use Relaxsd\ICalendar\Components\Traits\HasTimeZones;
use Relaxsd\ICalendar\Components\Traits\HasTodos;
use Relaxsd\ICalendar\Contracts\Writable;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Properties\Calendar\Traits\HasCalendarScale;
use Relaxsd\ICalendar\Properties\Calendar\Traits\HasMethod;
use Relaxsd\ICalendar\Properties\Calendar\Traits\HasProductIdentifier;
use Relaxsd\ICalendar\Properties\Calendar\Traits\HasVersion;
use Relaxsd\ICalendar\Properties\Misc\Traits\HasXProperties;

/**
 * Class Calendar
 *
 * 4.6 Calendar Components
 *
 * The body of the iCalendar object consists of a sequence of calendar
 * properties and one or more calendar components. The calendar
 * properties are attributes that apply to the calendar as a whole. The
 * calendar components are collections of properties that express a
 * particular calendar semantic. For example, the calendar component can
 * specify an event, a to-do, a journal entry, time zone information, or
 * free/busy time information, or an alarm.
 *
 * The body of the iCalendar object is defined by the following
 * notation:
 *
 * icalbody   = calprops component
 *
 * calprops   = 2*(
 *
 * ; 'prodid' and 'version' are both REQUIRED,
 * ; but MUST NOT occur more than once
 *
 * prodid /version /
 *
 * ; 'calscale' and 'method' are optional,
 * ; but MUST NOT occur more than once
 *
 * calscale        /
 * method          /
 *
 * x-prop
 *
 * )
 *
 * component  = 1*(eventc / todoc / journalc / freebusyc /
 * / timezonec / iana-comp / x-comp)
 *
 * iana-comp  = "BEGIN" ":" iana-token CRLF
 *
 * 1*contentline
 *
 * "END" ":" iana-token CRLF
 *
 * x-comp     = "BEGIN" ":" x-name CRLF
 *
 * 1*contentline
 *
 * "END" ":" x-name CRLF
 *
 * An iCalendar object MUST include the "PRODID" and "VERSION" calendar
 * properties. In addition, it MUST include at least one calendar
 * component. Special forms of iCalendar objects are possible to publish
 * just busy time (i.e., only a "VFREEBUSY" calendar component) or time
 * zone (i.e., only a "VTIMEZONE" calendar component) information. In
 * addition, a complex iCalendar object is possible that is used to
 * capture a complete snapshot of the contents of a calendar (e.g.,
 * composite of many different calendar components). More commonly, an
 * iCalendar object will consist of just a single "VEVENT", "VTODO" or
 * "VJOURNAL" calendar component.
 *
 * @package Relaxsd\ICalendar
 */
class Calendar implements Writable
{

    // Calendar Properties
    use HasProductIdentifier,
        HasVersion,
        HasCalendarScale,
        HasMethod,
        HasXProperties;

    // Components
    use HasEvents,
        HasTodos,
        HasJournals,
        HasFreeBusies,
        HasTimeZones,
        HasIanaComponents,
        HasExperimentalComponents;

    /**
     * Calendar constructor.
     *
     * @param string|null $version
     * @param string|null $maxVersion
     */
    public function __construct($version = '2.0', $maxVersion = null)
    {
        if (isset($version)) {
            $this->setVersion($version, $maxVersion);
        }
    }

    /**
     * @param \Relaxsd\ICalendar\Contracts\Writer $writer
     */
    function acceptWriter(Writer $writer)
    {
        $writer->writeCalendar($this);
    }

}
