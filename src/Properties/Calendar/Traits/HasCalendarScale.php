<?php

namespace Relaxsd\ICalendar\Properties\Calendar\Traits;

use Relaxsd\ICalendar\Properties\Calendar\CalendarScale;

/**
 * Trait HasCalendarScale
 *
 * @package Relaxsd\ICalendar\Properties\Calendar\Traits
 */
trait HasCalendarScale
{

    /**
     * @var \Relaxsd\ICalendar\Properties\Calendar\CalendarScale
     */
    protected $calendarScale;

    /**
     * @return \Relaxsd\ICalendar\Properties\Calendar\CalendarScale
     */
    public function getCalendarScale()
    {
        return $this->calendarScale;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\CalendarScale|integer $calendarScale
     *
     * @return $this
     */
    public function setCalendarScale($calendarScale)
    {
        $this->calendarScale = ($calendarScale instanceof CalendarScale)
            ? $calendarScale
            : new CalendarScale($calendarScale);

        return $this;
    }

}
