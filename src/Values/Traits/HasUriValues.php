<?php

namespace Relaxsd\ICalendar\Values\Traits;

/**
 * Trait HasUriValues
 *
 * 4.3.13 URI
 *
 * Value Name: URI
 *
 * Purpose: This value type is used to identify values that contain a
 * uniform resource identifier (URI) type of reference to the property
 * value.
 *
 * Formal Definition: The data type is defined by the following
 * notation:
 *
 * uri        = <As defined by any IETF RFC>
 *
 * Description: This data type might be used to reference binary
 * information, for values that are large, or otherwise undesirable to
 * include directly in the iCalendar object.
 *
 * The URI value formats in RFC 1738, RFC 2111 and any other IETF
 * registered value format can be specified.
 *
 * Any IANA registered URI format can be used. These include, but are
 * not limited to, those defined in RFC 1738 and RFC 2111.
 *
 * When a property parameter value is a URI value type, the URI MUST be
 * specified as a quoted-string value.
 *
 * No additional content value encoding (i.e., BACKSLASH character
 * encoding) is defined for this value type.
 *
 * Example: The following is a URI for a network file:
 *
 * http://host1.com/my-report.txt
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasUriValues
{

    /**
     * @var string[]
     */
    protected $uris;

    /**
     * @return string[]
     */
    public function getUris()
    {
        return $this->uris;
    }

    /**
     * @param string $uri
     * @param bool   $mailTo
     *
     * @return $this
     */
    public function addUri($uri, $mailTo = false)
    {
        $this->uris[] = $mailTo ? "MAILTO:{$uri}" : $uri;

        return $this;
    }

    /**
     * @param string[] $uris
     * @param bool     $mailTo
     *
     * @return $this
     */
    public function addUris($uris, $mailTo = false)
    {
        foreach ($uris as $uri) {
            $this->addUri($uri, $mailTo);
        }

        return $this;
    }

}
