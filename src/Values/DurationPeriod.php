<?php

namespace Relaxsd\ICalendar\Values;

use DateTime;
use Relaxsd\ICalendar\Values\Traits\HasDurationValue;

/**
 * Class DurationPeriod
 *
 * 4.3.9 Period of Time
 *
 * period-start = date-time "/" dur-value
 * ; [ISO 8601] complete representation basic format for a period of
 * ; time consisting of a start and positive duration of time.
 *
 * @package Relaxsd\ICalendar\Values
 */
class DurationPeriod extends Period
{
    use HasDurationValue;

    /**
     * Period constructor.
     *
     * @param DateTime|string|null $startDate
     * @param Duration|string|null $duration
     */
    public function __construct($startDate = null, $duration = null)
    {
        parent::__construct($startDate);

        if (isset($duration)) {
            $this->setDuration($duration);
        }
    }
}
