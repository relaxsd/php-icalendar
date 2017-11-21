<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class RecurrenceIdentifierRange
 *
 * 4.2.13  Recurrence Identifier Range
 *
 * Parameter Name: RANGE
 *
 * Purpose: To specify the effective range of recurrence instances from
 * the instance specified by the recurrence identifier specified by the
 * property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * rangeparam = "RANGE" "=" ("THISANDPRIOR"
 * ; To specify all instances prior to the recurrence identifier
 * / "THISANDFUTURE")
 * ; To specify the instance specified by the recurrence identifier
 * ; and all subsequent recurrence instances
 *
 * Description: The parameter can be specified on a property that
 * specifies a recurrence identifier. The parameter specifies the
 * effective range of recurrence instances that is specified by the
 * property. The effective range is from the recurrence identified
 * specified by the property. If this parameter is not specified an
 * allowed property, then the default range is the single instance
 * specified by the recurrence identifier value of the property. The
 * parameter value can be "THISANDPRIOR" to indicate a range defined by
 * the recurrence identified value of the property and all prior
 * instances. The parameter value can also be "THISANDFUTURE" to
 * indicate a range defined by the recurrence identifier and all
 * subsequent instances.
 *
 * Example:
 *
 * RECURRENCE-ID;RANGE=THISANDPRIOR:19980401T133000Z
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class RecurrenceIdentifierRange
{
    use HasValue;

    const RANGE_THIS_AND_PRIOR = 'THISANDPRIOR';
    const RANGE_THIS_AND_FUTURE = 'THISANDFUTURE';

    /**
     * RecurrenceIdentifierRange constructor.
     *
     * @param string $recurrence
     */
    public function __construct($recurrence)
    {
        $this->setValue($recurrence);
    }

}
