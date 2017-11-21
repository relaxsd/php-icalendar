<?php

namespace Relaxsd\ICalendar\Parameters;

use DateTime;
use Relaxsd\ICalendar\Properties\Alarm\AbsoluteTrigger;
use Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger;
use Relaxsd\ICalendar\Values\DurationPeriod;
use Relaxsd\ICalendar\Values\ExplicitPeriod;
use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class TimeZoneIdentifier
 *
 * 4.2.20 Value Data Types
 *
 * Parameter Name: VALUE
 *
 * Purpose: To explicitly specify the data type format for a property
 * value.
 *
 * Format Definition: The "VALUE" property parameter is defined by the
 * following notation:
 *
 * valuetypeparam = "VALUE" "=" valuetype
 *
 * valuetype  = ("BINARY"
 * / "BOOLEAN"
 * / "CAL-ADDRESS"
 * / "DATE"
 * / "DATE-TIME"
 * / "DURATION"
 * / "FLOAT"
 * / "INTEGER"
 * / "PERIOD"
 * / "RECUR"
 * / "TEXT"
 * / "TIME"
 * / "URI"
 * / "UTC-OFFSET"
 * / x-name
 * ; Some experimental iCalendar data type.
 * / iana-token)
 * ; Some other IANA registered iCalendar data type.
 *
 * Description: The parameter specifies the data type and format of the
 * property value. The property values MUST be of a single value type.
 * For example, a "RDATE" property cannot have a combination of DATE-
 * TIME and TIME value types.
 *
 * If the property's value is the default value type, then this
 * parameter need not be specified. However, if the property's default
 * value type is overridden by some other allowable value type, then
 * this parameter MUST be specified.
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class ValueDataType
{
    use HasValue;

    const VALUETYPE_BINARY = 'BINARY';
    const VALUETYPE_BOOLEAN = 'BOOLEAN';
    const VALUETYPE_CAL_ADDRESS = 'CAL-ADDRESS';
    const VALUETYPE_DATE = 'DATE';
    const VALUETYPE_DATE_TIME = 'DATE-TIME';
    const VALUETYPE_DURATION = 'DURATION';
    const VALUETYPE_FLOAT = 'FLOAT';
    const VALUETYPE_INTEGER = 'INTEGER';
    const VALUETYPE_PERIOD = 'PERIOD';
    const VALUETYPE_RECUR = 'RECUR';
    const VALUETYPE_TEXT = 'TEXT';
    const VALUETYPE_TIME = 'TIME';
    const VALUETYPE_URI = 'URI';
    const VALUETYPE_UTC_OFFSET = 'UTC-OFFSET';
    // / x-name
    // / iana-token

    /**
     * ValueDataType constructor.
     *
     * @param string $valueType
     */
    public function __construct($valueType)
    {
        $this->setValue($valueType);
    }

    /**
     * @param ValueDataType|string $valueDataType
     *
     * @return string
     */
    public static function valueOf($valueDataType)
    {
        if (!isset($valueDataType)) return null;

        return $valueDataType instanceof ValueDataType ? $valueDataType->getValue() : $valueDataType;
    }

    /**
     * @param mixed   $value
     *
     * @param boolean $allowDateType
     *
     * @return string
     */
    public static function determineValueType($value, $allowDateType = true)
    {
        // First check for HasPeriodValue, then HasDateTimeValue, because
        //
        if ($value instanceof DurationPeriod || $value instanceof RelativeTrigger) {

            return ValueDataType::VALUETYPE_DURATION;

        } elseif ($value instanceof ExplicitPeriod) {

            return $allowDateType && self::isMidnight($value->getStartDate()) && self::isMidnight($value->getEndDate())
                ? ValueDataType::VALUETYPE_DATE
                : ValueDataType::VALUETYPE_DATE_TIME;

        } elseif ($value instanceof AbsoluteTrigger) {

            return $allowDateType && self::isMidnight($value->getDateTime())
                ? ValueDataType::VALUETYPE_DATE
                : ValueDataType::VALUETYPE_DATE_TIME;

        } elseif ($value instanceof DateTime) {

            return $allowDateType && self::isMidnight($value)
                ? ValueDataType::VALUETYPE_DATE
                : ValueDataType::VALUETYPE_DATE_TIME;

        } else {
            throw new \LogicException('Cannot determine value type: unsupported value...');
        }
    }

    /**
     * @param DateTime $dateTime
     *
     * @return mixed
     */
    protected static function isMidnight($dateTime)
    {
        return $dateTime->format('Hisu') == 0;
    }
}
