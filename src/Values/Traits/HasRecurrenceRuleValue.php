<?php

namespace Relaxsd\ICalendar\Values\Traits;

use Relaxsd\ICalendar\Values\RecurrenceRule;

/**
 * Trait HasRecurrenceRuleValue
 *
 * @see     \Relaxsd\ICalendar\Values\RecurrenceRuleValue
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasRecurrenceRuleValue
{

    protected $recurrenceRule;

    /**
     * @return \Relaxsd\ICalendar\Values\RecurrenceRule
     */
    public function getRecurrenceRule()
    {
        return $this->recurrenceRule;
    }

    /**
     * @param \Relaxsd\ICalendar\Values\RecurrenceRule|string $recurrenceRule
     *
     * @return $this
     */
    public function setRecurrenceRule($recurrenceRule)
    {
        $this->recurrenceRule = ($recurrenceRule instanceof RecurrenceRule)
            ? $recurrenceRule
            : new RecurrenceRule($recurrenceRule);

        return $this;
    }

}
