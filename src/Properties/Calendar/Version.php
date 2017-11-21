<?php

namespace Relaxsd\ICalendar\Properties\Calendar;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;

/**
 * Class Version
 *
 * 4.7.4 Version
 *
 * Property Name: VERSION
 *
 * Purpose: This property specifies the identifier corresponding to the
 * highest version number or the minimum and maximum range of the
 * iCalendar specification that is required in order to interpret the
 * iCalendar object.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: This property MUST be specified by an iCalendar object,
 * but MUST only be specified once.
 *
 * Description: A value of "2.0" corresponds to this memo.
 *
 * Format Definition: The property is defined by the following notation:
 *
 * version    = "VERSION" verparam ":" vervalue CRLF
 *
 * verparam   = *(";" xparam)
 *
 * vervalue   = "2.0"         ;This memo
 * / maxver
 * / (minver ";" maxver)
 *
 * minver     = <A IANA registered iCalendar version identifier>
 * ;Minimum iCalendar version needed to parse the iCalendar object
 *
 * maxver     = <A IANA registered iCalendar version identifier>
 * ;Maximum iCalendar version needed to parse the iCalendar object
 *
 * Example: The following is an example of this property:
 *
 * RFC 2445                       iCalendar                   November 1998
 *
 * VERSION:2.0
 *
 * @package Relaxsd\ICalendar\Traits
 */
class Version
{
    use HasXParams;

    /**
     * @var string
     */
    protected $version;

    /**
     * Minimum iCalendar version needed to parse the iCalendar object
     *
     * @var string
     */
    protected $minVersion;

    /**
     * Maximum iCalendar version needed to parse the iCalendar object
     *
     * @var string
     */
    protected $maxVersion;

    /**
     * Version constructor.
     *
     * @param string|null $version
     * @param string|null $maxVersion
     */
    public function __construct($version = '2.0', $maxVersion = null)
    {
        if (isset($maxVersion)) {
            $this->minVersion = $version;
            $this->maxVersion = $maxVersion;
        } else {
            $this->version = $version;
        }
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getMinVersion()
    {
        return $this->minVersion;
    }

    /**
     * @param string $minVersion
     *
     * @return $this
     */
    public function setMinVersion($minVersion)
    {
        $this->minVersion = $minVersion;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaxVersion()
    {
        return $this->maxVersion;
    }

    /**
     * @param string $maxVersion
     *
     * @return $this
     */
    public function setMaxVersion($maxVersion)
    {
        $this->maxVersion = $maxVersion;
        return $this;
    }

    public function __toString()
    {
        return isset($this->version)
            ? $this->version
            : "{$this->minVersion};{$this->maxVersion}";
    }
}
