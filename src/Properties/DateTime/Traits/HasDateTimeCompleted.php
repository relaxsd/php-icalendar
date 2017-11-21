<?php

namespace Relaxsd\ICalendar\Properties\DateTime\Traits;

use Relaxsd\ICalendar\Properties\DateTime\DateTimeCompleted;

/**
 * Trait HasDateTimeCompleted
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\DateTimeCompleted
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDateTimeCompleted
{

    /**
     * @var \Relaxsd\ICalendar\Properties\DateTime\DateTimeCompleted
     */
    protected $dateTimeCompleted;

    /**
     * @return \Relaxsd\ICalendar\Properties\DateTime\DateTimeCompleted
     */
    public function getDateTimeCompleted()
    {
        return $this->dateTimeCompleted;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeCompleted|\DateTime|string $dateTimeCompleted
     *
     * @return $this
     */
    public function setDateTimeCompleted($dateTimeCompleted)
    {
        $this->dateTimeCompleted = ($dateTimeCompleted instanceof DateTimeCompleted)
            ? $dateTimeCompleted
            : new DateTimeCompleted($dateTimeCompleted);

        return $this;
    }

}
