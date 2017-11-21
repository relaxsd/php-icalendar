<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\Delegatees;

trait HasDelegatees
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\Delegatees
     */
    protected $delegatees;

    /**
     * @return \Relaxsd\ICalendar\Parameters\Delegatees
     */
    public function getDelegatees()
    {
        return $this->delegatees;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\Delegatees|string[][] $delegatees
     *
     * @return HasDelegatees
     */
    public function setDelegatees($delegatees)
    {
        $this->delegatees = $delegatees instanceof Delegatees
            ? $delegatees
            : new Delegatees($delegatees);

        return $this;
    }

}
