<?php

namespace Relaxsd\ICalendar\Properties\Descriptive;

use Relaxsd\ICalendar\Parameters\Traits\HasLanguage;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasTextValues;

/**
 * Class Categories
 *
 * 4.8.1.2 Categories
 *
 * Property Name: CATEGORIES
 *
 * Purpose: This property defines the categories for a calendar
 * component.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard and language property parameters
 * can be specified on this property.
 *
 * Conformance: The property can be specified within "VEVENT", "VTODO"
 * or "VJOURNAL" calendar components.
 *
 * Description: This property is used to specify categories or subtypes
 * of the calendar component. The categories are useful in searching for
 * a calendar component of a particular type and category. Within the
 * "VEVENT", "VTODO" or "VJOURNAL" calendar components, more than one
 * category can be specified as a list of categories separated by the
 * COMMA character (US-ASCII decimal 44).
 *
 * Format Definition: The property is defined by the following notation:
 *
 * categories = "CATEGORIES" catparam ":" text *("," text)
 * CRLF
 *
 * catparam   = *(
 *
 * ; the following is optional,
 * ; but MUST NOT occur more than once
 *
 * (";" languageparam ) /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 * (";" xparam)
 *
 * )
 *
 * Example: The following are examples of this property:
 *
 * CATEGORIES:APPOINTMENT,EDUCATION
 *
 * CATEGORIES:MEETING
 *
 * @package Relaxsd\ICalendar\Properties\Descriptive\Traits
 */
class Categories
{
    use HasLanguage,
        HasXParams,
        HasTextValues;

    const  CATEGORY_APPOINTMENT = "APPOINTMENT";
    const  CATEGORY_MEETING = "MEETING";
    const  CATEGORY_EDUCATION = "EDUCATION";
    
    /**
     * @param string[] $categories
     *
     * Categories constructor.
     */
    public function __construct($categories = [])
    {
        $this->addTextValues($categories);
    }

}
