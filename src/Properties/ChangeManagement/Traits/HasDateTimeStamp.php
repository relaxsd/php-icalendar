<?php

namespace Relaxsd\ICalendar\Properties\ChangeManagement\Traits;

use Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeStamp;

/**
 * Trait HasDateTimeStamp
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\DateTimeStamp
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDateTimeStamp
{

    /**
     * @var \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeStamp
     */
    protected $dateTimeStamp;

    /**
     * @return \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeStamp
     */
    public function getDateTimeStamp()
    {
        return $this->dateTimeStamp;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeStamp|\DateTime|string $dateTimeStamp
     *
     * @return $this
     */
    public function setDateTimeStamp($dateTimeStamp)
    {
        $this->dateTimeStamp = ($dateTimeStamp instanceof DateTimeStamp)
            ? $dateTimeStamp
            : new DateTimeStamp($dateTimeStamp);

        return $this;
    }

}
