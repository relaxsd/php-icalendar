<?php

namespace Relaxsd\ICalendar\Properties\Relationship\Traits;

use Relaxsd\ICalendar\Properties\Relationship\Attendee;

/**
 * Trait HasAttendees
 *
 * @see     \Relaxsd\ICalendar\Properties\Relationship\Attendee
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasAttendees
{
    /**
     * @var Attendee[]
     */
    protected $attendees = [];

    /**
     * @param Attendee $attendee
     *
     * @return $this
     */
    public function addAttendee(Attendee $attendee)
    {
        $this->attendees[] = $attendee;

        return $this;
    }

    /**
     * @return Attendee[]
     */
    public function getAttendees()
    {
        return $this->attendees;
    }
}
