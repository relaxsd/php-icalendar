<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\FormatType;
use Relaxsd\ICalendar\Parameters\Traits\HasFormatType;
use Relaxsd\ICalendar\Parameters\Traits\HasValueDataType;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Parameters\ValueDataType;

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
 * Property Parameters: Non-standard, inline encoding, format type and
 * value data type property parameters can be specified on this
 * property.
 *
 * Conformance: The property can be specified in a "VEVENT", "VTODO",
 * "VJOURNAL" or "VALARM" calendar components.
 *
 * Description: The property can be specified within "VEVENT", "VTODO",
 * "VJOURNAL", or "VALARM" calendar components. This property can be
 * specified multiple times within an iCalendar object.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * attach     = "ATTACH" attparam ":" uri  CRLF
 *
 * attach     =/ "ATTACH" attparam ";" "ENCODING" "=" "BASE64"
 * ";" "VALUE" "=" "BINARY" ":" binary
 *
 * attparam   = *(
 *
 * ; the following is optional,
 * ; but MUST NOT occur more than once
 *
 * (";" fmttypeparam) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 * (";" xparam)
 *
 * )
 *
 * Example: The following are examples of this property:
 *
 * ATTACH:CID:jsmith.part3.960817T083000.xyzMail@host1.com
 *
 * ATTACH;FMTTYPE=application/postscript:ftp://xyzCorp.com/pub/
 * reports/r-960812.ps
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\UriAttachment
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\BinaryAttachment
 *
 * @package Relaxsd\ICalendar
 */
abstract class Attachment
{
    use HasValueDataType,
        HasFormatType,
        HasXParams;

    const DEFAULT_VALUE_TYPE = ValueDataType::VALUETYPE_URI;

    /**
     * BaseAttachment constructor.
     *
     * @param FormatType|string|null $formatType
     */
    public function __construct($formatType = null)
    {
        if (isset($formatType)) {
            $this->setFormatType($formatType);
        }
    }

    /**
     * @param string      $uri
     * @param string|null $formatType
     *
     * @return \Relaxsd\ICalendar\Properties\Descriptive\UriAttachment
     */
    public static function createUriAttachment($uri, $formatType = null)
    {
        return new UriAttachment($uri, $formatType);
    }

    /**
     * @param string      $binaryValue
     * @param string|null $formatType
     *
     * @return \Relaxsd\ICalendar\Properties\Descriptive\BinaryAttachment
     */
    public static function createBinaryAttachment($binaryValue, $formatType = null)
    {
        return new BinaryAttachment($binaryValue, $formatType);
    }

}
