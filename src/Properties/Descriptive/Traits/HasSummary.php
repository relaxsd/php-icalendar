<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Summary;

/**
 * Trait HasSummary
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Summary
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasSummary
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Summary
     */
    protected $summary;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\Summary
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Summary|string $summary
     *
     * @return $this
     */
    public function setSummary($summary)
    {
        $this->summary = $summary instanceof Summary
            ? $summary
            : new Summary($summary);

        return $this;
    }

}
