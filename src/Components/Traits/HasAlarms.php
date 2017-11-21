<?php

namespace Relaxsd\ICalendar\Components\Traits;

use Relaxsd\ICalendar\Components\Alarm;

/**
 * Trait HasAlarms
 *
 * @see     \Relaxsd\ICalendar\Components\Alarm
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasAlarms
{

    /**
     * Alarm[]
     */
    protected $alarms = [];

    /**
     * @param \Relaxsd\ICalendar\Components\Alarm $alarm
     *
     * @return $this
     */
    public function addAlarm(Alarm $alarm)
    {
        $this->alarms[] = $alarm;

        return $this;
    }

    /**
     * @return \Relaxsd\ICalendar\Components\Alarm[]
     */
    public function getAlarms()
    {
        return $this->alarms;
    }

}
