<?php

namespace Relaxsd\ICalendar\Values\Traits;

use Relaxsd\ICalendar\Values\Period;

/**
 * Trait HasPeriodValue
 *
 * @see     \Relaxsd\ICalendar\Values\Period
 *
 * @package Relaxsd\ICalendar\Value\Traits
 */
trait HasPeriodValue
{

    /**
     * @var Period
     */
    protected $period;

    /**
     * @return Period
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param Period $period
     *
     * @return $this
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

}
