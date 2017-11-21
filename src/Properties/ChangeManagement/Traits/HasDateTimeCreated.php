<?php

namespace Relaxsd\ICalendar\Properties\ChangeManagement\Traits;

use Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeCreated;

/**
 * Trait HasDateTimeCreated
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\DateTimeCreated
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDateTimeCreated
{

    /**
     * @var \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeCreated
     */
    protected $dateTimeCreated;

    /**
     * @return \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeCreated
     */
    public function getDateTimeCreated()
    {
        return $this->dateTimeCreated;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\DateTimeCreated|\DateTime|string $dateTimeCreated
     *
     * @return $this
     */
    public function setDateTimeCreated($dateTimeCreated)
    {
        $this->dateTimeCreated = ($dateTimeCreated instanceof DateTimeCreated)
            ? $dateTimeCreated
            : new DateTimeCreated($dateTimeCreated);

        return $this;
    }

}
