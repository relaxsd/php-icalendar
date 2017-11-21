<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class DirectoryEntryReference
 *
 * 4.2.6 Directory Entry Reference
 *
 * Parameter Name: DIR
 *
 * Purpose: To specify reference to a directory entry associated with
 * the calendar user specified by the property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * dirparam   = "DIR" "=" DQUOTE uri DQUOTE
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. The parameter specifies a reference to the
 * directory entry associated with the calendar user specified by the
 * property. The parameter value is a URI. The individual URI parameter
 * values MUST each be specified in a quoted-string.
 *
 * Example:
 *
 * ORGANIZER;DIR="ldap://host.com:6666/o=eDABC%20Industries,c=3DUS??
 * (cn=3DBJim%20Dolittle)":MAILTO:jimdo@host1.com
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class DirectoryEntryReference
{
    use HasValue;

    /**
     * DirectoryEntryReference constructor.
     *
     * @param string $directoryEntryReference
     */
    public function __construct($directoryEntryReference)
    {
        $this->setValue($directoryEntryReference);
    }

}
