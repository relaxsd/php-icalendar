<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasParamTextValue;

/**
 * Class Timezone
 *
 * 4.2.19 Time Zone Identifier
 *
 * Parameter Name: TZID
 *
 * Purpose: To specify the identifier for the time zone definition for a
 * time component in the property value.
 *
 * Format Definition: This property parameter is defined by the
 * following notation:
 *
 * tzidparam  = "TZID" "=" [tzidprefix] paramtext CRLF
 *
 * tzidprefix = "/"
 *
 * Description: The parameter MUST be specified on the "DTSTART",
 * "DTEND", "DUE", "EXDATE" and "RDATE" properties when either a DATE-
 * TIME or TIME value type is specified and when the value is not either
 * a UTC or a "floating" time. Refer to the DATE-TIME or TIME value type
 * definition for a description of UTC and "floating time" formats. This
 * property parameter specifies a text value which uniquely identifies
 * the "VTIMEZONE" calendar component to be used when evaluating the
 * time portion of the property. The value of the TZID property
 * parameter will be equal to the value of the TZID property for the
 * matching time zone definition. An individual "VTIMEZONE" calendar
 * component MUST be specified for each unique "TZID" parameter value
 * specified in the iCalendar object.
 *
 * The parameter MUST be specified on properties with a DATE-TIME value
 * if the DATE-TIME is not either a UTC or a "floating" time.
 *
 * The presence of the SOLIDUS character (US-ASCII decimal 47) as a
 * prefix, indicates that this TZID represents a unique ID in a globally
 * defined time zone registry (when such registry is defined).
 *
 * Note: This document does not define a naming convention for time
 * zone identifiers. Implementers may want to use the naming
 * conventions defined in existing time zone specifications such as
 * the public-domain Olson database [TZ]. The specification of
 * globally unique time zone identifiers is not addressed by this
 * document and is left for future study.
 *
 * The following are examples of this property parameter:
 *
 * DTSTART;TZID=US-Eastern:19980119T020000
 *
 * DTEND;TZID=US-Eastern:19980119T030000
 *
 * The TZID property parameter MUST NOT be applied to DATE-TIME or TIME
 * properties whose time values are specified in UTC.
 *
 * The use of local time in a DATE-TIME or TIME value without the TZID
 * property parameter is to be interpreted as a local time value,
 * regardless of the existence of "VTIMEZONE" calendar components in the
 * iCalendar object.
 *
 * For more information see the sections on the data types DATE-TIME and
 * TIME.
 */
class TimezoneIdentifier
{
    const SOLIDUS = '/';

    use HasParamTextValue;

    /**
     * The presence of the SOLIDUS character (US-ASCII decimal 47) as a
     * prefix, indicates that this TZID represents a unique ID in a globally
     * defined time zone registry (when such registry is defined).
     *
     * @var string
     */
    protected $prefix;

    /**
     * TimezoneIdentifier constructor.
     *
     * @param string     $paramText
     * @param bool $unique
     *
     * @internal param string $prefix
     */
    public function __construct($paramText, $unique = false)
    {
        $this->setParamText($paramText);
        $this->setUnique($unique);
    }

    /**
     * @param boolean $unique
     *
     * @return $this
     */
    public function setUnique($unique)
    {
        $this->prefix = $unique ? self::SOLIDUS : null;

        return $this;
    }

    public function getUnique()
    {
        return $this->prefix == self::SOLIDUS;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

}
