<?php

namespace Relaxsd\ICalendar\Values\Traits;

use Relaxsd\ICalendar\Values\Duration;

/**
 * Trait HasDurationValue
 *
 * 4.3.6   Duration
 *
 * Value Name: DURATION
 *
 * Purpose: This value type is used to identify properties that contain
 * a duration of time.
 *
 * Formal Definition: The value type is defined by the following
 * notation:
 *
 * dur-value  = (["+"] / "-") "P" (dur-date / dur-time / dur-week)
 *
 * dur-date   = dur-day [dur-time]
 * dur-time   = "T" (dur-hour / dur-minute / dur-second)
 * dur-week   = 1*DIGIT "W"
 * dur-hour   = 1*DIGIT "H" [dur-minute]
 * dur-minute = 1*DIGIT "M" [dur-second]
 * dur-second = 1*DIGIT "S"
 * dur-day    = 1*DIGIT "D"
 *
 * Description: If the property permits, multiple "duration" values are
 * specified by a COMMA character (US-ASCII decimal 44) separated list
 * of values. The format is expressed as the [ISO 8601] basic format for
 * the duration of time. The format can represent durations in terms of
 * weeks, days, hours, minutes, and seconds.
 *
 * No additional content value encoding (i.e., BACKSLASH character
 * encoding) are defined for this value type.
 *
 * Example: A duration of 15 days, 5 hours and 20 seconds would be:
 *
 * P15DT5H0M20S
 *
 * A duration of 7 weeks would be:
 *
 * P7W
 *
 */
trait HasDurationValue
{

    /**
     * NB: Don't call this $value.
     * To be combined with other value traits like startDate.
     *
     * @var Duration
     */
    protected $duration;

    /**
     * @return Duration|null
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param Duration|string $duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = ($duration instanceof Duration)
            ? $duration
            : new Duration($duration);

        return $this;
    }

}
