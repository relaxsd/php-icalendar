<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class CommonName
 *
 * 4.2.2 Common Name
 *
 * Parameter Name: CN
 *
 * Purpose: To specify the common name to be associated with the
 * calendar user specified by the property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * cnparam    = "CN" "=" param-value
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. The parameter specifies the common name to be
 * associated with the calendar user specified by the property. The
 * parameter value is text. The parameter value can be used for display
 * text to be associated with the calendar address specified by the
 * property.
 *
 * Example:
 *
 * ORGANIZER;CN="John Smith":MAILTO:jsmith@host.com
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class CommonName
{
    use HasValue;

    /**
     * CommonName constructor.
     *
     * @param string $commonName
     */
    public function __construct($commonName)
    {
        $this->setValue($commonName);
    }

}
