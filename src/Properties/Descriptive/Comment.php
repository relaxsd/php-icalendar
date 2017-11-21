<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\Traits\HasAlternateTextRepresentation;
use Relaxsd\ICalendar\Parameters\Traits\HasLanguage;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasTextValue;

/**
 * Class Comment
 *
 * 4.8.1.4 Comment
 *
 * Property Name: COMMENT
 *
 * Purpose: This property specifies non-processing information intended
 * to provide a comment to the calendar user.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard, alternate text representation and
 * language property parameters can be specified on this property.
 *
 * Conformance: This property can be specified in "VEVENT", "VTODO",
 * "VJOURNAL", "VTIMEZONE" or "VFREEBUSY" calendar components.
 *
 * Comment: The property can be specified multiple times.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * comment    = "COMMENT" commparam ":" text CRLF
 *
 * commparam  = *(
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
 * COMMENT:The meeting really needs to include both ourselves
 * and the customer. We can't hold this  meeting without them.
 * As a matter of fact\, the venue for the meeting ought to be at
 * their site. - - John
 *
 * The data type for this property is TEXT.
 *
 * @package Relaxsd\ICalendar\Properties\Descriptive
 */
class Comment
{

    use HasAlternateTextRepresentation,
        HasLanguage,
        HasXParams,
        HasTextValue;

    /**
     * Comment constructor.
     *
     * @param string $comment
     */
    public function __construct($comment = null)
    {
        $this->setText($comment);
    }
}
