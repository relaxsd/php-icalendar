<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class Classifications
 *
 * 4.8.1.3 Classification
 *
 * Property Name: CLASS
 *
 * Purpose: This property defines the access value for a
 * calendar component.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: The property can be specified once in a "VEVENT",
 * "VTODO" or "VJOURNAL" calendar components.
 *
 * Description: An access value is only one component of the
 * general security system within a calendar application. It provides a
 * method of capturing the scope of the access the calendar owner
 * intends for information within an individual calendar entry. The
 * access value of an individual iCalendar component is useful
 * when measured along with the other security components of a calendar
 * system (e.g., calendar user authentication, authorization, access
 * rights, access role, etc.). Hence, the semantics of the individual
 * access values cannot be completely defined by this memo
 * alone. Additionally, due to the "blind" nature of most exchange
 * processes using this memo, these access values cannot serve
 * as an enforcement statement for a system receiving an iCalendar
 * object. Rather, they provide a method for capturing the intention of
 * the calendar owner for the access to the calendar component.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * class      = "CLASS" classparam ":" classvalue CRLF
 *
 * classparam = *(";" xparam)
 *
 * classvalue = "PUBLIC" / "PRIVATE" / "CONFIDENTIAL" / iana-token
 * / x-name
 * ;Default is PUBLIC
 *
 * Example: The following is an example of this property:
 *
 * CLASS:PUBLIC
 *
 * @see \Relaxsd\ICalendar\Contracts\Classification
 */
class Classification
{
    use HasXParams,
        HasValue;

    const  CLASSIFICATION_PUBLIC = "PUBLIC";
    const  CLASSIFICATION_PRIVATE = "PRIVATE";
    const  CLASSIFICATION_CONFIDENTIAL = "CONFIDENTIAL";
    // iana-token
    // x-name

    /**
     * Classification constructor.
     *
     * @param string $classification
     */
    public function __construct($classification = self::CLASSIFICATION_PUBLIC)
    {
        $this->setValue($classification);
    }

}
