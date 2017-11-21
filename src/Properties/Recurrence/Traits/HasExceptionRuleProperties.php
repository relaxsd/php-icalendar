<?php

namespace Relaxsd\ICalendar\Properties\Recurrence\Traits;

use Relaxsd\ICalendar\Properties\Recurrence\ExceptionRule;

/**
 * Trait HasExceptionRuleProperties
 *
 * @see     \Relaxsd\ICalendar\Properties\Recurrence\ExceptionRule
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasExceptionRuleProperties
{
    /**
     * @var ExceptionRule[]
     */
    protected $exceptionRules = [];

    /**
     * @param ExceptionRule $exceptionRule
     *
     * @return $this
     */
    public function addExceptionRule(ExceptionRule $exceptionRule)
    {
        $this->exceptionRules[] = $exceptionRule;

        return $this;
    }

    /**
     * @return ExceptionRule[]
     */
    public function getExceptionRules()
    {
        return $this->exceptionRules;
    }
}
