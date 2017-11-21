<?php

namespace Relaxsd\ICalendar\Values\Traits;

use DateTime;

trait HasEndDateTimeValue
{

    /**
     * NB: Don't call this $value.
     * To be combined with other value traits like startDate.
     *
     * @var DateTime
     */
    protected $endDate;

    /**
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param DateTime|string $endDate
     *
     * @return $this
     */
    public function setEndDate($endDate)
    {
        $this->endDate = ($endDate instanceof DateTime)
            ? $endDate
            : new DateTime($endDate);

        return $this;
    }

}
