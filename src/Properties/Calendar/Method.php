<?php

namespace Relaxsd\ICalendar\Properties\Calendar;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasIanaTokenValue;

/**
 * Class Method
 *
 * 4.7.2 Method
 *
 * Property Name: METHOD
 *
 * Purpose: This property defines the iCalendar object method associated
 * with the calendar object.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: The property can be specified in an iCalendar object.
 *
 * Description: When used in a MIME message entity, the value of this
 * property MUST be the same as the Content-Type "method" parameter
 * value. This property can only appear once within the iCalendar
 * object. If either the "METHOD" property or the Content-Type "method"
 * parameter is specified, then the other MUST also be specified.
 *
 * No methods are defined by this specification. This is the subject of
 * other specifications, such as the iCalendar Transport-independent
 * Interoperability Protocol (iTIP) defined by [ITIP].
 *
 * If this property is not present in the iCalendar object, then a
 * scheduling transaction MUST NOT be assumed. In such cases, the
 * iCalendar object is merely being used to transport a snapshot of some
 * calendar information; without the intention of conveying a scheduling
 * semantic.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * method     = "METHOD" metparam ":" metvalue CRLF
 *
 * metparam   = *(";" xparam)
 *
 * metvalue   = iana-token
 *
 * Example: The following is a hypothetical example of this property to
 * convey that the iCalendar object is a request for a meeting:
 *
 * METHOD:REQUEST
 *
 * @package Relaxsd\ICalendar\Properties\Calendar\Traits
 */
class Method
{
    use HasXParams,
        HasIanaTokenValue;

    /**
     * Method constructor.
     *
     * @param string $method
     */
    public function __construct($method)
    {
        $this->setIanaToken($method);
    }

}
