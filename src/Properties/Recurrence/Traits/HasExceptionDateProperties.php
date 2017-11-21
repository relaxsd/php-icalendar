<?php

namespace Relaxsd\ICalendar\Properties\Recurrence\Traits;

use Relaxsd\ICalendar\Properties\Recurrence\ExceptionDate;

/**
 * Trait HasExceptionDateProperties
 *
 * @see     \Relaxsd\ICalendar\Properties\Recurrence\ExceptionDate
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasExceptionDateProperties
{
    /**
     * @var ExceptionDate[]
     */
    protected $exceptionDates = [];

    /**
     * @param ExceptionDate $exceptionDate
     *
     * @return $this
     */
    public function addExceptionDate(ExceptionDate $exceptionDate)
    {
        $this->exceptionDates[] = $exceptionDate;

        return $this;
    }

    /**
     * @return ExceptionDate[]
     */
    public function getExceptionDates()
    {
        return $this->exceptionDates;
    }
}
