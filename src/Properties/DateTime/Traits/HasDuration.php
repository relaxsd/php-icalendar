<?php

namespace Relaxsd\ICalendar\Properties\DateTime\Traits;

use Relaxsd\ICalendar\Properties\DateTime\Duration;

/**
 * Trait HasDuration
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\Duration
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDuration
{

    /**
     * @var \Relaxsd\ICalendar\Properties\DateTime\Duration
     */
    protected $duration;

    /**
     * @return \Relaxsd\ICalendar\Properties\DateTime\Duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\Duration|string $duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = ($duration instanceof Duration)
            ? $duration
            : new Duration($duration);

        return $this;
    }

}
