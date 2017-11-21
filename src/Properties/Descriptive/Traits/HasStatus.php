<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Status;

/**
 * Trait HasStatus
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Status
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasStatus
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Status
     */
    protected $status;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Status|string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status instanceof Status
            ? $status
            : new Status($status);

        return $this;
    }

}
