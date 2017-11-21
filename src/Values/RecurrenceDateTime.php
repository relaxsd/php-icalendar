<?php

namespace Relaxsd\ICalendar\Values;

use DateTime;
use Relaxsd\ICalendar\Values\Traits\HasDateTimeValue;

class RecurrenceDateTime extends RecurrenceDate
{
    use HasDateTimeValue;

    /**
     * RecurrenceDatePeriod constructor.
     *
     * @param DateTime|string $dateTime
     */
    public function __construct($dateTime)
    {
        $this->setDateTime($dateTime);
    }

}
