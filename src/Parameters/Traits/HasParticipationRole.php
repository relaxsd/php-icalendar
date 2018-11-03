<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\ParticipationRole;

trait HasParticipationRole
{
    /**
     * @var \Relaxsd\ICalendar\Parameters\ParticipationRole
     */
    protected $participationRole;

    /**
     * @return \Relaxsd\ICalendar\Parameters\ParticipationRole
     */
    public function getParticipationRole()
    {
        return $this->participationRole;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\ParticipationRole|string $participationRole
     *
     * @return $this
     */
    public function setParticipationRole($participationRole)
    {
        $this->participationRole = $participationRole instanceof ParticipationRole
            ? $participationRole
            : new ParticipationRole($participationRole);

        return $this;
    }

}
