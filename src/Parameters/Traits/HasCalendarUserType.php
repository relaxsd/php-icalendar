<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\CalendarUserType;

/**
 * Trait HasCalendarUserType
 *
 * @see     \Relaxsd\ICalendar\Parameters\CalendarUserType
 *
 * @package Relaxsd\ICalendar\Parameters\Traits
 */
trait HasCalendarUserType
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\CalendarUserType
     */
    protected $calendarUserType;

    /**
     * @return \Relaxsd\ICalendar\Parameters\CalendarUserType
     */
    public function getCalendarUserType()
    {
        return $this->calendarUserType;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\CalendarUserType|string $calendarUserType
     *
     * @return $this
     */
    public function setCalendarUserType($calendarUserType)
    {
        $this->calendarUserType = $calendarUserType instanceof CalendarUserType
            ? $calendarUserType
            : new CalendarUserType($calendarUserType);

        return $this;
    }

}
