<?php

namespace Relaxsd\ICalendar\Properties\Alarm;

use Relaxsd\ICalendar\Parameters\AlarmTriggerRelationShip;
use Relaxsd\ICalendar\Parameters\Traits\HasAlarmTriggerRelationship;
use Relaxsd\ICalendar\Parameters\Traits\HasValueDataType;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\Duration;
use Relaxsd\ICalendar\Values\Traits\HasDurationValue;

/**
 * Class RelativeTrigger
 *
 * @package Relaxsd\ICalendar\Properties\Alarm
 */
class RelativeTrigger extends Trigger
{
    use HasValueDataType,
        HasAlarmTriggerRelationship,
        HasXParams,
        HasDurationValue;

    const DEFAULT_RELATED_TYPE = AlarmTriggerRelationShip::RELATED_START;

    /**
     * RelativeTrigger constructor.
     *
     * @param Duration|string $duration
     * @param string          $related
     */
    public function __construct($duration = null, $related = AlarmTriggerRelationShip::RELATED_START)
    {
        if (isset($duration)) {
            $this
                ->setValueDataType(ValueDataType::VALUETYPE_DURATION)
                ->setDuration($duration);
        }
        $this->setAlarmTriggerRelationship($related);
    }

    /**
     * @param integer      $days
     * @param integer|null $hours
     * @param integer|null $minutes
     * @param integer|null $seconds
     * @param string       $related
     *
     * @return $this
     */
    public static function forDaysBeforehand($days, $hours = null, $minutes = null, $seconds = null, $related = AlarmTriggerRelationShip::RELATED_START)
    {
        return new self(Duration::forDays($days, $hours, $minutes, $seconds)->beforehand(), $related);
    }

    /**
     * @param integer $weeks
     * @param string  $related
     *
     * @return \Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger
     */
    public static function forWeeksBeforehand($weeks, $related = AlarmTriggerRelationShip::RELATED_START)
    {
        return new self(Duration::forWeeks($weeks)->beforehand(), $related);
    }

    /**
     * @param integer      $hours
     * @param integer|null $minutes
     * @param integer|null $seconds
     * @param string       $related
     *
     * @return \Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger
     */
    public static function forHoursBeforehand($hours, $minutes = null, $seconds = null, $related = AlarmTriggerRelationShip::RELATED_START)
    {
        return new self(Duration::forHours($hours, $minutes, $seconds)->beforehand(), $related);
    }

    /**
     * @param integer      $minutes
     * @param integer|null $seconds
     * @param string       $related
     *
     * @return \Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger
     */
    public static function forMinutesBeforehand($minutes, $seconds = null, $related = AlarmTriggerRelationShip::RELATED_START)
    {
        return new self(Duration::forMinutes($minutes, $seconds)->beforehand(), $related);
    }

    /**
     * @param integer|null $seconds
     * @param string       $related
     *
     * @return \Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger
     */
    public static function forSecondsBeforehand($seconds, $related = AlarmTriggerRelationShip::RELATED_START)
    {
        return new self(Duration::forSeconds($seconds)->beforehand(), $related);
    }

}
