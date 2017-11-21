<?php

namespace Relaxsd\ICalendar\Properties\DateTime\Traits;

use Relaxsd\ICalendar\Properties\DateTime\DateTimeEnd;

/**
 * Trait HasDateTimeEnd
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\DateTimeEnd
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDateTimeEnd
{

    /**
     * @var \Relaxsd\ICalendar\Properties\DateTime\DateTimeEnd
     */
    protected $dateTimeEnd;

    /**
     * @return \Relaxsd\ICalendar\Properties\DateTime\DateTimeEnd
     */
    public function getDateTimeEnd()
    {
        return $this->dateTimeEnd;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeEnd|\DateTime|string $dateTimeEnd
     *
     * @return $this
     */
    public function setDateTimeEnd($dateTimeEnd)
    {
        $this->dateTimeEnd = ($dateTimeEnd instanceof DateTimeEnd)
            ? $dateTimeEnd
            : new DateTimeEnd($dateTimeEnd);

        return $this;
    }

}
