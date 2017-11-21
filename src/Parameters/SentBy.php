<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasUriValue;

/**
 * Class SentBy
 *
 * 4.2.18  Sent By
 *
 * Parameter Name: SENT-BY
 *
 * Purpose: To specify the calendar user that is acting on behalf of the
 * calendar user specified by the property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * sentbyparam        = "SENT-BY" "=" DQUOTE cal-address DQUOTE
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. The parameter specifies the calendar user
 * that is acting on behalf of the calendar user specified by the
 * property. The parameter value MUST be a MAILTO URI as defined in [RFC
 * 1738]. The individual calendar address parameter values MUST each be
 * specified in a quoted-string.
 *
 * Example:
 *
 * ORGANIZER;SENT-BY:"MAILTO:sray@host.com":MAILTO:jsmith@host.com
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class SentBy
{

    use HasUriValue;

    /**
     * SentBy constructor.
     *
     * @param string $uri
     * @param bool   $mailTo
     */
    public function __construct($uri, $mailTo = false)
    {
        $this->setUri($uri, $mailTo);
    }

}
