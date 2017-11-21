<?php

namespace Relaxsd\ICalendar\Properties\Alarm\Traits;

use DateTime;
use Relaxsd\ICalendar\Properties\Alarm\AbsoluteTrigger;
use Relaxsd\ICalendar\Properties\Alarm\Trigger;

/**
 * Trait HasTrigger
 *
 * @see     \Relaxsd\ICalendar\Properties\Alarm\Trigger
 *
 * @package Relaxsd\ICalendar\Properties\Alarm\Traits
 */
trait HasTrigger
{

    /**
     * @var Trigger
     */
    protected $trigger;

    /**
     * @return Trigger
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * @param Trigger|DateTime|string $trigger
     *
     * @return $this
     */
    public function setTrigger($trigger)
    {
        $this->trigger = ($trigger instanceof Trigger)
            ? $trigger
            : new AbsoluteTrigger($trigger);

        return $this;
    }

}
