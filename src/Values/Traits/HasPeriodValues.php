<?php

namespace Relaxsd\ICalendar\Values\Traits;

use Relaxsd\ICalendar\Parameters\Traits\HasValueDataType;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\Period;

/**
 * Trait HasPeriodValues
 *
 * @see     \Relaxsd\ICalendar\Values\Period
 *
 * @package Relaxsd\ICalendar\Values\Traits
 */
trait HasPeriodValues
{
    use HasValueDataType;

    /**
     * @var Period[]
     */
    protected $periods = [];

    /**
     * @return Period[]
     */
    public function getPeriods()
    {
        return $this->periods;
    }

    /**
     * @param Period[]                  $periods
     *
     * @return $this
     */
    public function addPeriods($periods)
    {
        foreach ($periods as $period) {
            $this->addPeriod($period);
        }

        return $this;
    }

    /**
     * @param Period                    $period
     *
     * @return $this
     */
    public function addPeriod($period)
    {
        $this->periods[] = $period;

        // Always PERIOD.
        $this->setValueDataType(ValueDataType::VALUETYPE_PERIOD);

        return $this;
    }

}
