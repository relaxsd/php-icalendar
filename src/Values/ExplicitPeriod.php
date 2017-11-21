<?php

namespace Relaxsd\ICalendar\Values;

use Relaxsd\ICalendar\Values\Traits\HasEndDateTimeValue;

/**
 * Class Period
 *
 * 4.3.9 Period of Time
 *
 * period-explicit = date-time "/" date-time
 * ; [ISO 8601] complete representation basic format for a period of
 * ; time consisting of a start and end. The start MUST be before the
 * ; end.
 *
 * @package Relaxsd\ICalendar\Values
 */
class ExplicitPeriod extends Period
{
    use HasEndDateTimeValue;

    /**
     * Period constructor.
     *
     * @param \DateTime|string|null $startDate
     * @param \DateTime|string|null $endDate
     */
    public function __construct($startDate = null, $endDate = null)
    {
        parent::__construct($startDate);

        if (isset($endDate)) {
            $this->setEndDate($endDate);
        }
    }

}
