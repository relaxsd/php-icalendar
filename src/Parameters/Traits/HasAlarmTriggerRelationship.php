<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\AlarmTriggerRelationShip;

/**
 * Trait HasAlarmTriggerRelationship
 *
 * @see     \Relaxsd\ICalendar\Parameters\AlarmTriggerRelationShip
 *
 * @package Relaxsd\ICalendar\Parameters\Traits
 */
trait HasAlarmTriggerRelationship
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\AlarmTriggerRelationShip
     */
    protected $alarmTriggerRelationship;

    /**
     * @return \Relaxsd\ICalendar\Parameters\AlarmTriggerRelationShip
     */
    public function getAlarmTriggerRelationship()
    {
        return $this->alarmTriggerRelationship;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\AlarmTriggerRelationShip|string $alarmTriggerRelationship
     *
     * @return $this
     */
    public function setAlarmTriggerRelationship($alarmTriggerRelationship)
    {
        $this->alarmTriggerRelationship = $alarmTriggerRelationship instanceof AlarmTriggerRelationShip
            ? $alarmTriggerRelationship
            : new AlarmTriggerRelationShip($alarmTriggerRelationship);

        return $this;
    }

}
