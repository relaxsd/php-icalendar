<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class InlineEncoding
 *
 * 4.2.7 Inline Encoding
 *
 * Parameter Name: ENCODING
 *
 * Purpose: To specify an alternate inline encoding for the property
 * value.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * encodingparam      = "ENCODING" "="
 * ("8BIT"
 * ; "8bit" text encoding is defined in [RFC 2045]
 * / "BASE64"
 * ; "BASE64" binary encoding format is defined in [RFC 2045]
 * / iana-token
 * ; Some other IANA registered iCalendar encoding type
 * / x-name)
 * ; A non-standard, experimental encoding type
 *
 * Description: The property parameter identifies the inline encoding
 * used in a property value. The default encoding is "8BIT",
 * corresponding to a property value consisting of text. The "BASE64"
 * encoding type corresponds to a property value encoded using the
 * "BASE64" encoding defined in [RFC 2045].
 *
 * If the value type parameter is ";VALUE=BINARY", then the inline
 * encoding parameter MUST be specified with the value
 * ";ENCODING=BASE64".
 *
 * Example:
 *
 * ATTACH;FMTYPE=IMAGE/JPEG;ENCODING=BASE64;VALUE=BINARY:MIICajC
 * CAdOgAwIBAgICBEUwDQYJKoZIhvcNAQEEBQAwdzELMAkGA1UEBhMCVVMxLDA
 * qBgNVBAoTI05ldHNjYXBlIENvbW11bmljYXRpb25zIENvcnBvcmF0aW9uMRw
 * <...remainder of "BASE64" encoded binary data...>
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class InlineEncoding
{
    use HasValue;

    /**
     * InlineEncoding constructor.
     *
     * @param string $inlineEncoding
     */
    public function __construct($inlineEncoding)
    {
        $this->setValue($inlineEncoding);
    }

}
