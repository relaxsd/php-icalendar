<?php

namespace Relaxsd\ICalendar\Properties\DateTime;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Duration as DurationValue;
use Relaxsd\ICalendar\Values\Traits\HasDurationValue;

/**
 * Class Duration
 *
 * 4.8.2.5 Duration
 *
 * Property Name: DURATION
 *
 * Purpose: The property specifies a positive duration of time.
 *
 * Value Type: DURATION
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: The property can be specified in "VEVENT", "VTODO",
 * "VFREEBUSY" or "VALARM" calendar components.
 *
 * Description: In a "VEVENT" calendar component the property may be
 * used to specify a duration of the event, instead of an explicit end
 * date/time. In a "VTODO" calendar component the property may be used
 * to specify a duration for the to-do, instead of an explicit due
 * date/time. In a "VFREEBUSY" calendar component the property may be
 * used to specify the interval of free time being requested. In a
 * "VALARM" calendar component the property may be used to specify the
 * delay period prior to repeating an alarm.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * duration   = "DURATION" durparam ":" dur-value CRLF
 * ;consisting of a positive duration of time.
 *
 * durparam   = *(";" xparam)
 *
 * Example: The following is an example of this property that specifies
 * an interval of time of 1 hour and zero minutes and zero seconds:
 *
 * DURATION:PT1H0M0S
 *
 * The following is an example of this property that specifies an
 * interval of time of 15 minutes.
 *
 * DURATION:PT15M
 */
class Duration
{
    use HasXParams,
        HasDurationValue;

    /**
     * Duration constructor.
     *
     * @param string|null $duration
     */
    public function __construct($duration = null)
    {
        if (isset($duration)) {
            $this->setDuration($duration);
        }
    }

    /**
     * @param integer $weeks
     *
     * @return $this
     */
    public static function forWeeks($weeks)
    {
        return (new self(DurationValue::forWeeks($weeks)));
    }

    /**
     * @param integer      $days
     * @param integer|null $hours
     * @param integer|null $minutes
     * @param integer|null $seconds
     *
     * @return $this
     */
    public static function forDays($days, $hours = null, $minutes = null, $seconds = null)
    {
        return (new self(DurationValue::forDays($days, $hours, $minutes, $seconds)));
    }

    /**
     * @param integer|null $hours
     * @param integer|null $minutes
     * @param integer|null $seconds
     *
     * @return $this
     */
    public static function forHours($hours = null, $minutes = null, $seconds = null)
    {
        return (new self(DurationValue::forHours($hours, $minutes, $seconds)));
    }

    /**
     * @param integer|null $minutes
     * @param integer|null $seconds
     *
     * @return $this
     */
    public static function forMinutes($minutes = null, $seconds = null)
    {
        return (new self(DurationValue::forMinutes($minutes, $seconds)));
    }

    /**
     * @param integer|null $seconds
     *
     * @return $this
     */
    public static function forSeconds($seconds = null)
    {
        return (new self(DurationValue::forSeconds($seconds)));
    }

}
