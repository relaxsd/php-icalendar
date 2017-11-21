<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\Traits\HasAlternateTextRepresentation;
use Relaxsd\ICalendar\Parameters\Traits\HasLanguage;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasTextValue;

/**
 * Class Summary
 *
 * 4.8.1.12 Summary
 *
 * Property Name: SUMMARY
 *
 * Purpose: This property defines a short summary or subject for the
 * calendar component.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard, alternate text representation and
 * language property parameters can be specified on this property.
 *
 * Conformance: The property can be specified in "VEVENT", "VTODO",
 * "VJOURNAL" or "VALARM" calendar components.
 *
 * Description: This property is used in the "VEVENT", "VTODO" and
 * "VJOURNAL" calendar components to capture a short, one line summary
 * about the activity or journal entry.
 *
 * This property is used in the "VALARM" calendar component to capture
 * the subject of an EMAIL category of alarm.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * summary    = "SUMMARY" summparam ":" text CRLF
 *
 * summparam  = *(
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
 * SUMMARY:Department Party
 *
 * @package Relaxsd\ICalendar\Properties\Descriptive
 */
class Summary
{
    use HasAlternateTextRepresentation,
        HasLanguage,
        HasXParams,
        HasTextValue;

    /**
     * Summary constructor.
     *
     * @param string $summary
     */
    public function __construct($summary = null)
    {
        $this->setText($summary);
    }

}
