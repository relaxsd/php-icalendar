<?php

namespace Relaxsd\ICalendar\Properties\Relationship\Traits;

/**
 * Trait HasRecurrenceId
 *
 * @see     \Relaxsd\ICalendar\Properties\Relationship\RecurrenceId
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasRecurrenceId
{

    protected $recurrenceId;

    /**
     * @return \Relaxsd\ICalendar\Properties\Relationship\RecurrenceId
     */
    public function getRecurrenceId()
    {
        return $this->recurrenceId;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\RecurrenceId $recurrenceId
     *
     * @return $this
     */
    public function setRecurrenceId($recurrenceId)
    {
        $this->recurrenceId = $recurrenceId;
        return $this;
    }

}
