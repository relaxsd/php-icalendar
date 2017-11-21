<?php

namespace Relaxsd\ICalendar\Formatter;

use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Parameters\ValueDataType;

/**
 * Class BaseWriter
 *
 * @package Relaxsd\ICalendar\Formatter
 */
abstract class BaseWriter implements Writer
{

    protected $options = [
        'wrap' => 75,
        'force-value' => false
    ];

    protected $output = '';

    /**
     * @param string          $name
     * @param array           $params
     * @param string|string[] $value
     */
    protected function writeProperty($name, $params, $value)
    {
        $nonEmptyPairsString = $this->nonEmptyPairsString($params);

        if ($nonEmptyPairsString) {
            $name .= ';' . $nonEmptyPairsString;
        }

        if (is_array($value)) {
            // E.g. for Recurring Rule values
            $value = $this->nonEmptyPairsString($value);
        }

        $this->line("{$name}:{$value}");
    }

    /**
     * @param string $s
     *
     * @return $this
     */
    protected function line($s)
    {

        $this->output .= self::fold($s, $this->options['wrap']) . "\n";

        return $this;
    }

    /**
     * 4.1 Content Lines
     *
     * ...
     *
     * Lines of text SHOULD NOT be longer than 75 octets, excluding the line
     * break. Long content lines SHOULD be split into a multiple line
     * representations using a line "folding" technique. That is, a long
     * line can be split between any two characters by inserting a CRLF
     * immediately followed by a single linear white space character (i.e.,
     * SPACE, US-ASCII decimal 32 or HTAB, US-ASCII decimal 9). Any sequence
     * of CRLF followed immediately by a single linear white space character
     * is ignored (i.e., removed) when processing the content type.
     *
     * @param string $s
     * @param int    $wrap
     *
     * @return string
     */
    protected static function fold($s, $wrap = 75)
    {
        // Because we add an extra space to each broken line, they tend to get 76 instead of 75.
        // As a workaround, remove the first character, split in (n-1) to allow room for the spaces.
        // and then restore the character for the first line.
        return substr($s, 0, 1) . wordwrap(substr($s, 1), $wrap - 1, "\n ", true);
    }

    protected static function escapeText($s)
    {
        //     4.3.11 Text
        //
        //  ESCAPED-CHAR = "\\" / "\;" / "\," / "\N" / "\n")
        //     ; \\ encodes \, \N or \n encodes newline, \; encodes ;, \, encodes ,
        return str_replace(['\\', ';', ',', "\n"], ['\\\\', '\\;', '\\,', "\\n\n "], $s);
    }

    /**
     * @param \DateTime       $date
     *
     * @param ValueDataType|string $valueType
     *
     * @return false|string
     */
    protected static function formatDate(\DateTime $date, $valueType = ValueDataType::VALUETYPE_DATE_TIME)
    {
        $valueType = is_string($valueType) ? $valueType : $valueType->getValue();

        switch ($valueType) {
            case ValueDataType::VALUETYPE_DATE_TIME:

                if ($date->getTimezone()->getName() == 'UTC') {
                    return $date->format("Ymd\THis\Z");
                }
                return $date->format("Ymd\THis");

            case ValueDataType::VALUETYPE_DATE:
                return $date->format("Ymd");

            default:
                throw new \LogicException("Unsupported Date Type '{$valueType}");
        }
    }

    /**
     * @param string $s
     *
     * @return string
     */
    protected static function quotePrintable($s)
    {
        return str_replace("\r", "=0D=0A=", $s);
    }

    protected static function paramValue($val)
    {
        // Check for param-value        = paramtext / quoted-string
        return "\"{$val}\"";
    }

    protected static function doubleQuoted($value)
    {
        return "\"{$value}\"";
    }

    /**
     * @param string[] $values
     *
     * @return array|string
     */
    protected static function doubleQuotedArray($values)
    {
        return array_map(function ($el) {
            return self::doubleQuoted($el);
        }, $values);
    }

    /**
     * @param string[] $values
     *
     * @return string
     */
    protected static function doubleQuotedValuesString($values)
    {
        return implode(',', self::doubleQuotedArray($values));
    }

    /**
     * @param string[] $values
     *
     * @return string
     */
    protected static function textValuesString($values)
    {
        return implode(',', $values);
    }

    /**
     * @param \DateTime[] $dateTimeValues
     *
     * @return string
     */
    protected static function dateTimeValuesString($dateTimeValues)
    {
        return implode(',', array_map(function ($dateTime) {
            return self::formatDate($dateTime);
        }, $dateTimeValues));
    }

    /**
     * @param boolean $value
     *
     * @return string
     */
    protected static function booleanString($value)
    {
        return $value ? 'TRUE' : 'FALSE';
    }

    /**
     * @param string[] $params
     *
     * @return string
     */
    protected function nonEmptyPairsString($params)
    {
        $nonEmptyParams = array_filter($params, function ($value) {
            return !!$value;
        });

        $nonEmptyPairs = [];
        foreach ($nonEmptyParams as $key => $value) {
            $nonEmptyPairs[] = "{$key}={$value}";
        };

        return implode(';', $nonEmptyPairs);
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }

}
