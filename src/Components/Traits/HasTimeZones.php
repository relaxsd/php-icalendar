<?php

namespace Relaxsd\ICalendar\Components\Traits;

use Relaxsd\ICalendar\Components\TimeZone;

/**
 * Trait HasTimeZones
 *
 * @see     \Relaxsd\ICalendar\Components\TimeZone
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasTimeZones
{

    /**
     * @var \Relaxsd\ICalendar\Components\TimeZone[]
     */
    protected $timeZone = [];

    /**
     * @param \Relaxsd\ICalendar\Components\TimeZone $timeZone
     *
     * @return $this
     */
    public function addTimeZone(TimeZone $timeZone)
    {
        $this->timeZone[] = $timeZone;

        return $this;
    }

    /**
     * @return \Relaxsd\ICalendar\Components\TimeZone[]
     */
    public function getTimeZones()
    {
        return $this->timeZone;
    }

}
