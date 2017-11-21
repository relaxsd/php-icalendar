<?php

namespace Relaxsd\ICalendar\Properties\Calendar;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class ProductIdentifier
 *
 * 4.7.3 Product Identifier
 *
 * Property Name: PRODID
 *
 * Purpose: This property specifies the identifier for the product that
 * created the iCalendar object.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: The property MUST be specified once in an iCalendar
 * object.
 *
 * Description: The vendor of the implementation SHOULD assure that this
 * is a globally unique identifier; using some technique such as an FPI
 * value, as defined in [ISO 9070].
 *
 * This property SHOULD not be used to alter the interpretation of an
 * iCalendar object beyond the semantics specified in this memo. For
 * example, it is not to be used to further the understanding of non-
 * standard properties.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * prodid     = "PRODID" pidparam ":" pidvalue CRLF
 *
 * pidparam   = *(";" xparam)
 *
 * pidvalue   = text
 * ;Any text that describes the product and version
 * ;and that is generally assured of being unique.
 *
 * Example: The following is an example of this property. It does not
 * imply that English is the default language.
 *
 * PRODID:-//ABC Corporation//NONSGML My Product//EN
 *
 * @package Relaxsd\ICalendar\Traits
 */
class ProductIdentifier
{
    use HasXParams,
        HasValue;

    /**
     * ProductIdentifier constructor.
     *
     * @param string $productIdentifier
     */
    public function __construct($productIdentifier)
    {
        $this->setValue($productIdentifier);
    }

}
