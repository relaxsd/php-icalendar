<?php

namespace Relaxsd\ICalendar\Properties\Recurrence\Traits;

use Relaxsd\ICalendar\Properties\Recurrence\RecurrenceRule;

/**
 * Trait HasRecurrenceRules
 *
 * @see     \Relaxsd\ICalendar\Properties\Recurrence\RecurrenceRule
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasRecurrenceRuleProperties
{
    /**
     * @var RecurrenceRule[]
     */
    protected $recurrenceRules = [];

    /**
     * @param RecurrenceRule $recurrenceRule
     *
     * @return $this
     */
    public function addRecurrenceRule(RecurrenceRule $recurrenceRule)
    {
        $this->recurrenceRules[] = $recurrenceRule;

        return $this;
    }

    /**
     * @return RecurrenceRule[]
     */
    public function getRecurrenceRules()
    {
        return $this->recurrenceRules;
    }
}
