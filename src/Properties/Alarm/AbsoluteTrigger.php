<?php

namespace Relaxsd\ICalendar\Properties\Alarm;

use DateTime;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\Traits\HasDateTimeValue;

/**
 * Class AbsoluteTrigger
 *
 * @package Relaxsd\ICalendar\Properties\Alarm
 */
class AbsoluteTrigger extends Trigger
{
    use HasDateTimeValue,
        HasXParams;

    /**
     * AbsoluteTrigger constructor.
     *
     * @param DateTime|string|null $dateTime
     */
    public function __construct($dateTime = null)
    {
        if (isset($dateTime)) {
            $this
                ->setValueDataType(ValueDataType::VALUETYPE_DATE_TIME)
                ->setDateTime($dateTime);
        }
    }

    /**
     * @param DateTime|string $dateTime
     *
     * @return self
     */
    public static function forDateTime($dateTime)
    {
        return new self($dateTime);
    }

}
