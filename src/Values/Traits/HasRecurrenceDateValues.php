<?php

namespace Relaxsd\ICalendar\Values\Traits;

use Relaxsd\ICalendar\Parameters\Traits\HasValueDataType;
use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\RecurrenceDate;

/**
 * Trait HasRecurrenceDateValues
 *
 * 4.8.5.3 Recurrence Date/Times
 *
 * rdtval     = date-time / date / period
 * ;Value MUST match value type
 *
 */
trait HasRecurrenceDateValues
{
    use HasValueDataType;

    /**
     * @var RecurrenceDate[]
     */
    protected $recurrenceDates = [];

    /**
     * @return RecurrenceDate[]
     */
    public function getRecurrenceDates()
    {
        return $this->recurrenceDates;
    }

    /**
     * @param RecurrenceDate[]          $recurrenceDates
     * @param ValueDataType|string|null $valueType
     *
     * @return $this
     */
    public function addRecurrenceDates($recurrenceDates, $valueType = null)
    {
        foreach ($recurrenceDates as $recurrenceDate) {
            $this->addRecurrenceDate($recurrenceDate, $valueType);
        }

        return $this;
    }

    /**
     * @param RecurrenceDate            $recurrenceDate
     * @param ValueDataType|string|null $valueType
     *
     * @return $this
     */
    public function addRecurrenceDate($recurrenceDate, $valueType = null)
    {
        $this->recurrenceDates[] = $recurrenceDate;

        $this->setValueDataType($valueType ?: ValueDataType::determineValueType($recurrenceDate));

        return $this;
    }

}
