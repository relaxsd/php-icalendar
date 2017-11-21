<?php

namespace Relaxsd\ICalendar\Values;

/**
 * Class RecurrenceDate
 *
 * 4.8.5.3 Recurrence Date/Times
 *
 * rdtval     = date-time / date / period
 * ;Value MUST match value type
 *
 * @package Relaxsd\ICalendar\Values
 */
abstract class RecurrenceDate
{

    /**
     * @param Period[] $periods
     *
     * @return RecurrenceDatePeriod[]
     */
    public static function forPeriods($periods)
    {
        return array_map(function (Period $period) {
            return self::forPeriod($period);
        }, $periods);
    }

    /**
     * @param Period $period
     *
     * @return RecurrenceDatePeriod
     */
    public static function forPeriod(Period $period)
    {
        return new RecurrenceDatePeriod($period);
    }

    /**
     * @param \DateTime[] $dateTimes
     *
     * @return RecurrenceDateTime[]
     */
    public static function forDateTimes($dateTimes)
    {
        return array_map(function (\DateTime $dt) {
            return self::forDateTime($dt);
        }, $dateTimes);
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return RecurrenceDateTime
     */
    public static function forDateTime($dateTime)
    {
        return new RecurrenceDateTime($dateTime);
    }
}
