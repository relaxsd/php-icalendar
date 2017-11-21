<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\ValueDataType;
use Relaxsd\ICalendar\Parameters\FormatType;
use Relaxsd\ICalendar\Values\Traits\HasUriValue;

/**
 * Class Attachment
 * 4.8.1.1 Attachment
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
class UriAttachment extends Attachment
{
    use HasUriValue;

    /**
     * UriAttachment constructor.
     *
     * @param string                 $uri
     * @param FormatType|string|null $formatType
     */
    public function __construct($uri, $formatType = null)
    {
        parent::__construct($formatType);

        $this
            ->setValueDataType(ValueDataType::VALUETYPE_URI)
            ->setUri($uri);

    }

    /**
     * @param string $uri
     *
     * @return self
     */
    public static function forAudioUrl($uri)
    {
        return new self($uri, FormatType::FORMAT_TYPE_AUDIO_BASIC);
    }

    /**
     * @param string $uri
     *
     * @return self
     */
    public static function forBinaryUrl($uri)
    {
        return new self($uri, FormatType::FORMAT_TYPE_BINARY);
    }

    /**
     * @param string $uri
     *
     * @return self
     */
    public static function forProcedureUrl($uri)
    {
        return new self($uri, FormatType::FORMAT_TYPE_PROCEDURE);
    }

}
