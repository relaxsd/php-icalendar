<?php

namespace Relaxsd\ICalendar\Components\Traits;

use Relaxsd\ICalendar\Components\FreeBusy;

/**
 * Trait HasFreeBusies
 *
 * @see     \Relaxsd\ICalendar\Components\FreeBusy
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasFreeBusies
{

    /**
     * FreeBusy[]
     */
    protected $freeBusies = [];

    /**
     * @param \Relaxsd\ICalendar\Components\FreeBusy $freeBusy
     *
     * @return $this
     */
    public function addFreeBusy(FreeBusy $freeBusy)
    {
        $this->freeBusies[] = $freeBusy;

        return $this;
    }

    /**
     * @return \Relaxsd\ICalendar\Components\FreeBusy[]
     */
    public function getFreeBusies()
    {
        return $this->freeBusies;
    }

}
