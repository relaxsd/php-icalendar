<?php

namespace Relaxsd\ICalendar\Properties\Calendar\Traits;

use Relaxsd\ICalendar\Properties\Calendar\Version;

/**
 * Trait HasVersion
 *
 * @see     \Relaxsd\ICalendar\Properties\Calendar\Version
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasVersion
{

    /**
     * @var Version
     */
    protected $version;

    /**
     * @return Version
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param Version|string $version
     *
     * @param string|null    $maxVersion
     *
     * @return $this
     */
    public function setVersion($version, $maxVersion = null)
    {
        $this->version = is_string($version)
            ? new Version($version, $maxVersion)
            : $version;

        return $this;
    }

}
