<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasUriValue;

/**
 * Class AlternateTextRepresentation
 *
 * 4.2.1 Alternate Text Representation
 *
 * Parameter Name: ALTREP
 *
 * Purpose: To specify an alternate text representation for the property
 * value.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * altrepparam        = "ALTREP" "=" DQUOTE uri DQUOTE
 *
 * Description: The parameter specifies a URI that points to an
 * alternate representation for a textual property value. A property
 * specifying this parameter MUST also include a value that reflects the
 * default representation of the text value. The individual URI
 * parameter values MUST each be specified in a quoted-string.
 *
 * Example:
 *
 * DESCRIPTION;ALTREP="CID:<part3.msg.970415T083000@host.com>":Project
 * XYZ Review Meeting will include the following agenda items: (a)
 * Market Overview, (b) Finances, (c) Project Management
 *
 * The "ALTREP" property parameter value might point to a "text/html"
 * content portion.
 *
 * Content-Type:text/html
 * Content-Id:<part3.msg.970415T083000@host.com>
 *
 * <html><body>
 * <p><b>Project XYZ Review Meeting</b> will include the following
 * agenda items:<ol><li>Market
 * Overview</li><li>Finances</li><li>Project Management</li></ol></p>
 * </body></html>
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class AlternateTextRepresentation
{
    use HasUriValue;

    /**
     * AlternateTextRepresentation constructor.
     *
     * @param string $uri
     */
    public function __construct($uri)
    {
        $this->setUri($uri);
    }

}
