<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Values\Traits\HasBinaryValue;

/**
 * Class Attachment
 *
 * 4.8.1.1 Attachment
 *
 * Property Name: ATTACH
 *
 * Purpose: The property provides the capability to associate a document
 * object with a calendar component.
 *
 * Value Type: The default value type for this property is URI. The
 * value type can also be set to BINARY to indicate inline binary
 * encoded content information.
 *
 * @package Relaxsd\ICalendar
 */
class BinaryAttachment extends Attachment
{
    use HasBinaryValue;

    /**
     * BinaryAttachment constructor.
     *
     * @param string      $binaryValue
     * @param string|null $formatType
     * @param string      $encoding
     */
    public function __construct($binaryValue, $formatType = null, $encoding = 'BASE64')
    {
        parent::__construct($formatType);

        $this
            ->setValueDataType(ValueDataType::VALUETYPE_BINARY)
            ->setBinaryValue($binaryValue, $encoding);

    }

}
