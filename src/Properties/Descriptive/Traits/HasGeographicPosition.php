<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\GeographicPosition;

/**
 * Trait HasGeographicPosition
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\GeographicPosition
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasGeographicPosition
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\GeographicPosition
     */
    protected $geographicPosition;

    /**
     * @return GeographicPosition
     */
    public function getGeographicPosition()
    {
        return $this->geographicPosition;
    }

    /**
     * @param GeographicPosition|array $geographicPosition
     *
     * @return $this
     */
    public function setGeographicPosition($geographicPosition)
    {
        $this->geographicPosition = $geographicPosition instanceof GeographicPosition
            ? $geographicPosition
            : new GeographicPosition(...$geographicPosition);

        return $this;
    }

}
