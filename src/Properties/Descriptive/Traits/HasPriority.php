<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Priority;

/**
 * Trait HasPriority
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Priority
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasPriority
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Priority
     */
    protected $priority;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\Priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Priority|integer $priority
     *
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority instanceof Priority
            ? $priority
            : new Priority($priority);

        return $this;
    }

}
