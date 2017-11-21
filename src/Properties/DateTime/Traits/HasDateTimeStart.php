<?php

namespace Relaxsd\ICalendar\Properties\DateTime\Traits;

use Relaxsd\ICalendar\Properties\DateTime\DateTimeStart;

/**
 * Trait HasDateTimeStart
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\DateTimeStart
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDateTimeStart
{

    /**
     * @var \Relaxsd\ICalendar\Properties\DateTime\DateTimeStart
     */
    protected $dateTimeStart;

    /**
     * @return \Relaxsd\ICalendar\Properties\DateTime\DateTimeStart
     */
    public function getDateTimeStart()
    {
        return $this->dateTimeStart;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeStart|\DateTime|string $dateTimeStart
     *
     * @return $this
     */
    public function setDateTimeStart($dateTimeStart)
    {
        $this->dateTimeStart = ($dateTimeStart instanceof DateTimeStart)
            ? $dateTimeStart
            : new DateTimeStart($dateTimeStart);

        return $this;
    }

}
