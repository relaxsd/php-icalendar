<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\PercentComplete;

/**
 * Trait HasPercentComplete
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\PercentComplete
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasPercentComplete
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\PercentComplete
     */
    protected $percentComplete;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\PercentComplete
     */
    public function getPercentComplete()
    {
        return $this->percentComplete;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\PercentComplete|integer $percentComplete
     *
     * @return $this
     */
    public function setPercentComplete($percentComplete)
    {
        $this->percentComplete = $percentComplete instanceof PercentComplete
            ? $percentComplete
            : new PercentComplete($percentComplete);

        return $this;
    }

}
