<?php

namespace Relaxsd\ICalendar\Values\Traits;

/**
 * Trait HasBinaryValue
 *
 * 4.1.3 Binary Content
 *
 * Binary content information in an iCalendar object SHOULD be
 * referenced using a URI within a property value. That is the binary
 * content information SHOULD be placed in an external MIME entity that
 * can be referenced by a URI from within the iCalendar object. In
 * applications where this is not feasible, binary content information
 * can be included within an iCalendar object, but only after first
 * encoding it into text using the "BASE64" encoding method defined in
 * [RFC 2045]. Inline binary contact SHOULD only be used in applications
 * whose special circumstances demand that an iCalendar object be
 * expressed as a single entity. A property containing inline binary
 * content information MUST specify the "ENCODING" property parameter.
 * Binary content information placed external to the iCalendar object
 * MUST be referenced by a uniform resource identifier (URI).
 *
 * The following example specifies an "ATTACH" property that references
 * an attachment external to the iCalendar object with a URI reference:
 *
 * ATTACH:http://xyz.com/public/quarterly-report.doc
 *
 * The following example specifies an "ATTACH" property with inline
 * binary encoded content information:
 *
 * ATTACH;FMTTYPE=image/basic;ENCODING=BASE64;VALUE=BINARY:
 * MIICajCCAdOgAwIBAgICBEUwDQYJKoZIhvcNAQEEBQAwdzELMAkGA1U
 * EBhMCVVMxLDAqBgNVBAoTI05ldHNjYXBlIENvbW11bmljYXRpb25zIE
 * <...remainder of "BASE64" encoded binary data...>
 *
 * @package Relaxsd\ICalendar\Values\Traits
 */
trait HasBinaryValue
{

    /**
     * @var string;
     */
    protected $binaryValue;

    /**
     * @var string;
     */
    protected $encoding = 'BASE64';

    /**
     * @return string
     */
    public function getBinaryValue()
    {
        return $this->binaryValue;
    }

    /**
     * @param string $binaryValue
     * @param string $encoding
     *
     * @return $this
     */
    public function setBinaryValue($binaryValue, $encoding = 'BASE64')
    {
        $this->binaryValue = $binaryValue;
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     *
     * @return $this
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
        return $this;
    }


}
