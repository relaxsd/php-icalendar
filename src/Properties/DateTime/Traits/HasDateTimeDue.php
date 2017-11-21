<?php

namespace Relaxsd\ICalendar\Properties\DateTime\Traits;

use Relaxsd\ICalendar\Properties\DateTime\DateTimeDue;

/**
 * Trait HasDateTimeDue
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\DateTimeDue
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDateTimeDue
{

    /**
     * @var \Relaxsd\ICalendar\Properties\DateTime\DateTimeDue
     */
    protected $dateTimeDue;

    /**
     * @return \Relaxsd\ICalendar\Properties\DateTime\DateTimeDue
     */
    public function getDateTimeDue()
    {
        return $this->dateTimeDue;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\DateTime\DateTimeDue|\DateTime|string $dateTimeDue
     *
     * @return $this
     */
    public function setDateTimeDue($dateTimeDue)
    {
        $this->dateTimeDue = ($dateTimeDue instanceof DateTimeDue)
            ? $dateTimeDue
            : new DateTimeDue($dateTimeDue);

        return $this;
    }

}
