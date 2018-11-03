<?php

namespace Relaxsd\ICalendar\Values;

/**
 * Class Duration
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
class Duration
{

    /**
     * @var string
     */
    protected $value = 'P';

    /**
     * Duration constructor.
     *
     * @param string|null $value
     */
    public function __construct($value = null)
    {
        $this->value = $value ?: 'P';
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    // ====================== static factory methods

    /**
     * @param integer $weeks
     *
     * @return $this
     */
    public static function forWeeks($weeks)
    {
        return (new self())->weeks($weeks);
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
        return (new self())->date($days, $hours, $minutes, $seconds);
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
        return ((new self())->time($hours, $minutes, $seconds));
    }

    /**
     * @param integer|null $minutes
     * @param integer|null $seconds
     *
     * @return $this
     */
    public static function forMinutes($minutes = null, $seconds = null)
    {
        return ((new self())->time(null, $minutes, $seconds));
    }

    /**
     * @param integer|null $seconds
     *
     * @return $this
     */
    public static function forSeconds($seconds = null)
    {
        return ((new self())->time(null, null, $seconds));
    }

    // ====================== public, fluent interface

    /**
     * @param integer      $days
     * @param integer|null $hours
     * @param integer|null $minutes
     * @param integer|null $seconds
     *
     * @return $this
     */
    public function date($days, $hours = null, $minutes = null, $seconds = null)
    {
        $this->d($days);
        $this->time($hours, $minutes, $seconds);

        return $this;
    }

    /**
     * @param integer|null $hours
     * @param integer|null $minutes
     * @param integer|null $seconds
     *
     * @return $this
     */
    public function time($hours = null, $minutes = null, $seconds = null)
    {
        if (isset($hours) || isset($minutes) || isset($seconds)) {
            $this->addSuffix('T');
        }

        $this->h($hours);
        $this->m($minutes);
        $this->s($seconds);

        return $this;
    }

    /**
     * @param integer $weeks
     *
     * @return $this
     */
    public function weeks($weeks)
    {
        $this->w($weeks);

        return $this;
    }

    /**
     * @return $this
     */
    public function afterwards()
    {
        $this->addPrefix('+');
        return $this;
    }

    /**
     * @return $this
     */
    public function beforehand()
    {
        $this->addPrefix('-');
        return $this;
    }

    // =============================================

    public function w($weeks)
    {
        if (isset($weeks)) {
            $this->addSuffix("{$weeks}W");
        }
    }

    protected function d($days)
    {
        if (isset($days)) {
            $this->addSuffix("{$days}D");
        }
    }

    protected function h($hours)
    {
        if (isset($hours)) {
            $this->addSuffix("{$hours}H");
        }
    }

    protected function m($minutes)
    {
        if (isset($minutes)) {
            $this->addSuffix("{$minutes}M");
        }
    }

    protected function s($seconds)
    {
        if (isset($seconds)) {
            $this->addSuffix("{$seconds}S");
        }
    }

    // ============================================

    protected function addPrefix($prefix)
    {
        $this->value = $prefix . $this->value;
    }

    protected function addSuffix($suffix)
    {
        $this->value .= $suffix;
    }

}
