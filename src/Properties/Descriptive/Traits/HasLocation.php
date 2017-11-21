<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Location;

/**
 * Trait HasLocation
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Location
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasLocation
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Location
     */
    protected $location;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Location|string $location
     *
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = $location instanceof Location
            ? $location
            : new Location($location);

        return $this;
    }

}
