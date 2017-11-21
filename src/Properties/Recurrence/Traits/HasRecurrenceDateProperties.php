<?php

namespace Relaxsd\ICalendar\Properties\Recurrence\Traits;

use Relaxsd\ICalendar\Properties\Recurrence\RecurrenceDate;

/**
 * Trait HasRecurrenceDates
 *
 * @see     \Relaxsd\ICalendar\Properties\Recurrence\RecurrenceDate
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasRecurrenceDateProperties
{
    /**
     * @var RecurrenceDate[]
     */
    protected $recurrenceDateTimes = [];

    /**
     * @param RecurrenceDate $recurrenceDateTime
     *
     * @return $this
     */
    public function addRecurrenceDate(RecurrenceDate $recurrenceDateTime)
    {
        $this->recurrenceDateTimes[] = $recurrenceDateTime;

        return $this;
    }

    /**
     * @return RecurrenceDate[]
     */
    public function getRecurrenceDates()
    {
        return $this->recurrenceDateTimes;
    }
}
