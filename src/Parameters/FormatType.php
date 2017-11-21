<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class FormatType
 *
 * 4.2.8 Format Type
 *
 * Parameter Name: FMTTYPE
 *
 * Purpose: To specify the content type of a referenced object.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * fmttypeparam       = "FMTTYPE" "=" iana-token
 * ; A IANA registered content type
 * / x-name
 * ; A non-standard content type
 *
 * Description: This parameter can be specified on properties that are
 * used to reference an object. The parameter specifies the content type
 * of the referenced object. For example, on the "ATTACH" property, a
 * FTP type URI value does not, by itself, necessarily convey the type
 * of content associated with the resource. The parameter value MUST be
 * the TEXT for either an IANA registered content type or a non-standard
 * content type.
 *
 * Example:
 *
 * ATTACH;FMTTYPE=application/binary:ftp://domain.com/pub/docs/
 * agenda.doc
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class FormatType
{
    use HasValue;

    const FORMAT_TYPE_POSTSCRIPT = 'application/postscript';
    const FORMAT_TYPE_AUDIO_BASIC = 'audio/basic';
    const FORMAT_TYPE_BINARY = 'application/binary';
    const FORMAT_TYPE_PROCEDURE = 'procedure';

    /**
     * FormatType constructor.
     *
     * @param string $formatType
     */
    public function __construct($formatType)
    {
        $this->setValue($formatType);
    }

    /**
     * @param FormatType|string $formatType
     *
     * @return string
     */
    public static function valueOf($formatType)
    {
        if (!isset($formatType)) return null;

        return $formatType instanceof FormatType ? $formatType->getValue() : $formatType;
    }

}
