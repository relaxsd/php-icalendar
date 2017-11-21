<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class RelationshipType
 *
 * 4.2.15 Relationship Type
 *
 * Parameter Name: RELTYPE
 *
 * Purpose: To specify the type of hierarchical relationship associated
 * with the calendar component specified by the property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * reltypeparam       = "RELTYPE" "="
 * ("PARENT"      ; Parent relationship. Default.
 * / "CHILD"       ; Child relationship
 * / "SIBLING      ; Sibling relationship
 * / iana-token    ; Some other IANA registered
 * ; iCalendar relationship type
 * / x-name)       ; A non-standard, experimental
 * ; relationship type
 *
 * Description: This parameter can be specified on a property that
 * references another related calendar. The parameter specifies the
 * hierarchical relationship type of the calendar component referenced
 * by the property. The parameter value can be PARENT, to indicate that
 * the referenced calendar component is a superior of calendar
 * component; CHILD to indicate that the referenced calendar component
 * is a subordinate of the calendar component; SIBLING to indicate that
 * the referenced calendar component is a peer of the calendar
 * component. If this parameter is not specified on an allowable
 * property, the default relationship type is PARENT.
 *
 * Example:
 *
 * RELATED-TO;RELTYPE=SIBLING:<19960401-080045-4000F192713@host.com>
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class RelationshipType
{
    use HasValue;

    const RELATED_PARENT = 'PARENT';
    const RELATED_CHILD = 'CHILD';
    const RELATED_SIBLING = 'SIBLING';

    /**
     * RelationshipType constructor.
     *
     * @param string $relationshipType
     */
    public function __construct($relationshipType)
    {
        $this->setValue($relationshipType);
    }

}
