<?php

namespace Relaxsd\ICalendar\Values\Traits;

use DateTime;

trait HasStartDateTimeValue
{

    /**
     * NB: Don't call this $value.
     * To be combined with other value traits like endDate or duration.
     *
     * @var DateTime
     */
    protected $startDate;

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param DateTime|string $startDate
     *
     * @return $this
     */
    public function setStartDate($startDate)
    {
        $this->startDate = ($startDate instanceof DateTime)
            ? $startDate
            : new DateTime($startDate);

        return $this;
    }

}
