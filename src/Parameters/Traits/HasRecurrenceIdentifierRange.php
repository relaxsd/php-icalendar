<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\RecurrenceIdentifierRange;

trait HasRecurrenceIdentifierRange
{

    /**
     * @var RecurrenceIdentifierRange
     */
    protected $recurrenceIdentifierRange;

    /**
     * @return RecurrenceIdentifierRange
     */
    public function getRecurrenceIdentifierRange()
    {
        return $this->recurrenceIdentifierRange;
    }

    /**
     * @param RecurrenceIdentifierRange $recurrenceIdentifierRange
     *
     * @return $this
     */
    public function setRecurrenceIdentifierRange($recurrenceIdentifierRange)
    {
        $this->recurrenceIdentifierRange = $recurrenceIdentifierRange;

        return $this;
    }

}
