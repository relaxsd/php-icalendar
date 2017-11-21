<?php

namespace Relaxsd\ICalendar\Properties\DateTime\Traits;

use Relaxsd\ICalendar\Properties\DateTime\FreeBusy;
use Relaxsd\ICalendar\Values\Period;

/**
 * Trait HasFreeBusies
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\FreeBusy
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
     * @param FreeBusy|Period[]|Period|null $freeBusy
     *
     * @return $this
     */
    public function addFreeBusy($freeBusy)
    {
        $this->freeBusies[] = $freeBusy instanceof FreeBusy
            ? $freeBusy
            : new FreeBusy($freeBusy);

        return $this;
    }

    /**
     * @return FreeBusy[]
     */
    public function getFreeBusies()
    {
        return $this->freeBusies;
    }

}
