<?php

namespace Relaxsd\ICalendar\Properties\DateTime\Traits;

use Relaxsd\ICalendar\Properties\DateTime\TimeTransparency;

/**
 * Trait HasTimeTransparency
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\TimeTransparency
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasTimeTransparency
{

    /**
     * @var \Relaxsd\ICalendar\Properties\DateTime\TimeTransparency
     */
    protected $timeTransparency;

    /**
     * @return \Relaxsd\ICalendar\Properties\DateTime\TimeTransparency
     */
    public function getTimeTransparency()
    {
        return $this->timeTransparency;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\TimeTransparency|string $timeTransparency
     *
     * @return $this
     */
    public function setTimeTransparency($timeTransparency)
    {
        $this->timeTransparency = ($timeTransparency instanceof TimeTransparency)
            ? $timeTransparency
            : new TimeTransparency($timeTransparency);

        return $this;
    }

}
