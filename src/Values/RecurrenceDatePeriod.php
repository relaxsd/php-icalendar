<?php

namespace Relaxsd\ICalendar\Values;

use Relaxsd\ICalendar\Values\Traits\HasPeriodValue;

class RecurrenceDatePeriod extends RecurrenceDate
{
    use HasPeriodValue;

    /**
     * RecurrenceDatePeriod constructor.
     *
     * @param Period $period
     */
    public function __construct($period)
    {
        $this->setPeriod($period);
    }

}
