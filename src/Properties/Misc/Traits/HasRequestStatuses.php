<?php

namespace Relaxsd\ICalendar\Properties\Misc\Traits;

use Relaxsd\ICalendar\Properties\Misc\RequestStatus;

/**
 * Trait HasRequestStatuses
 *
 * @see     \Relaxsd\ICalendar\Properties\Misc\RequestStatus
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasRequestStatuses
{
    /**
     * @var RequestStatus[]
     */
    protected $requestStatuses = [];

    /**
     * @param RequestStatus $requestStatus
     *
     * @return $this
     */
    public function addRequestStatus(RequestStatus $requestStatus)
    {
        $this->requestStatuses[] = $requestStatus;

        return $this;
    }

    /**
     * @return RequestStatus[]
     */
    public function getRequestStatuses()
    {
        return $this->requestStatuses;
    }
}
