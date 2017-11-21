<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\Traits\HasAlternateTextRepresentation;
use Relaxsd\ICalendar\Parameters\Traits\HasLanguage;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasTextValues;

/**
 * Class Resources
 *
 * 4.8.1.10 Resources
 *
 * Property Name: RESOURCES
 *
 * Purpose: This property defines the equipment or resources anticipated
 * for an activity specified by a calendar entity..
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard, alternate text representation and
 * language property parameters can be specified on this property.
 *
 * Conformance: This property can be specified in "VEVENT" or "VTODO"
 * calendar component.
 *
 * Description: The property value is an arbitrary text. More than one
 * resource can be specified as a list of resources separated by the
 * COMMA character (US-ASCII decimal 44).
 *
 * Format Definition: The property is defined by the following notation:
 *
 * resources  = "RESOURCES" resrcparam ":" text *("," text) CRLF
 *
 * resrcparam = *(
 *
 * ; the following are optional,
 * ; but MUST NOT occur more than once
 *
 * (";" altrepparam) / (";" languageparam) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 * (";" xparam)
 *
 * )
 *
 * Example: The following is an example of this property:
 *
 * RESOURCES:EASEL,PROJECTOR,VCR
 *
 * RESOURCES;LANGUAGE=fr:1 raton-laveur
 *
 * @package Relaxsd\ICalendar\Properties\Descriptive\Traits
 */
class Resources
{
    use HasAlternateTextRepresentation,
        HasLanguage,
        HasXParams,
        HasTextValues;

    /**
     * @param string[] $resources
     *
     * Resources constructor.
     */
    public function __construct($resources = [])
    {
        $this->addTextValues($resources);
    }

}
