<?php

namespace Relaxsd\ICalendar\Properties\Alarm\Traits;

use Relaxsd\ICalendar\Properties\Alarm\RepeatCount;

/**
 * Trait HasRepeatCount
 *
 * @see     \Relaxsd\ICalendar\Properties\Alarm\RepeatCount
 *
 * @package Relaxsd\ICalendar\Properties\Alarm\Traits
 */
trait HasRepeatCount
{

    /**
     * @var \Relaxsd\ICalendar\Properties\Alarm\RepeatCount
     */
    protected $repeatCount;

    /**
     * @return \Relaxsd\ICalendar\Properties\Alarm\RepeatCount
     */
    public function getRepeatCount()
    {
        return $this->repeatCount;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Alarm\RepeatCount|integer $repeatCount
     *
     * @return $this
     */
    public function setRepeatCount($repeatCount)
    {
        $this->repeatCount = ($repeatCount instanceof RepeatCount)
            ? $repeatCount
            : new RepeatCount($repeatCount);

        return $this;
    }

}
