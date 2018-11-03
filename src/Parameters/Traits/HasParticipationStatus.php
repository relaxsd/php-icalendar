<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\ParticipationStatus;

trait HasParticipationStatus
{
    /**
     * @var \Relaxsd\ICalendar\Parameters\ParticipationStatus
     */
    protected $participationStatus;

    /**
     * @return \Relaxsd\ICalendar\Parameters\ParticipationStatus
     */
    public function getParticipationStatus()
    {
        return $this->participationStatus;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\ParticipationStatus|string $participationStatus
     *
     * @return $this
     */
    public function setParticipationStatus($participationStatus)
    {
        $this->participationStatus = $participationStatus instanceof ParticipationStatus
            ? $participationStatus
            : new ParticipationStatus($participationStatus);

        return $this;
    }

}
