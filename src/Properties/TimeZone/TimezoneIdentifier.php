<?php

namespace Relaxsd\ICalendar\Parameters\TimeZone;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasTextValue;

/**
 * Class Timezone
 *
 * 4.8.3.1 Time Zone Identifier
 *
 * Property Name: TZID
 *
 * Purpose: This property specifies the text value that uniquely
 * identifies the "VTIMEZONE" calendar component.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: This property MUST be specified in a "VTIMEZONE"
 * calendar component.
 *
 * Description: This is the label by which a time zone calendar
 * component is referenced by any iCalendar properties whose data type
 * is either DATE-TIME or TIME and not intended to specify a UTC or a
 * "floating" time. The presence of the SOLIDUS character (US-ASCII
 * decimal 47) as a prefix, indicates that this TZID represents an
 * unique ID in a globally defined time zone registry (when such
 * registry is defined).
 *
 * Note: This document does not define a naming convention for time
 * zone identifiers. Implementers may want to use the naming
 * conventions defined in existing time zone specifications such as
 * the public-domain Olson database [TZ]. The specification of
 * globally unique time zone identifiers is not addressed by this
 * document and is left for future study.
 *
 * Format Definition: This property is defined by the following
 * notation:
 *
 * tzid       = "TZID" tzidpropparam ":" [tzidprefix] text CRLF
 *
 * tzidpropparam      = *(";" xparam)
 *
 * ;tzidprefix        = "/"
 * ; Defined previously. Just listed here for reader convenience.
 *
 * Example: The following are examples of non-globally unique time zone
 * identifiers:
 *
 * TZID:US-Eastern
 *
 * TZID:California-Los_Angeles
 *
 * The following is an example of a fictitious globally unique time zone
 * identifier:
 * TZID:/US-New_York-New_York
 *
 */
class TimezoneIdentifier
{
    use HasXParams,
        HasTextValue;

    const SOLIDUS = '/';

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
     * @param string $text
     * @param bool   $unique
     *
     * @internal param string $prefix
     */
    public function __construct($text, $unique = false)
    {
        $this->setText($text);
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
