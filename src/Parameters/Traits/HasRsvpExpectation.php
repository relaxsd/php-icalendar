<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\RsvpExpectation;

trait HasRsvpExpectation
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\RsvpExpectation
     */
    protected $rsvpExpectation;

    /**
     * @return \Relaxsd\ICalendar\Parameters\RsvpExpectation
     */
    public function getRsvpExpectation()
    {
        return $this->rsvpExpectation;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\RsvpExpectation|boolean $rsvpExpectation
     *
     * @return HasRsvpExpectation
     */
    public function setRsvpExpectation($rsvpExpectation)
    {
        $this->rsvpExpectation = $rsvpExpectation instanceof RsvpExpectation
            ? $rsvpExpectation
            : new RsvpExpectation($rsvpExpectation);

        return $this;
    }

}
