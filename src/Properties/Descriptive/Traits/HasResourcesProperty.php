<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Resources;

/**
 * Trait HasResourcesProperty
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Resources
 *
 * @package Relaxsd\ICalendar\Properties\Descriptive\Traits
 */
trait HasResourcesProperty
{

    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Resources
     */
    protected $resources;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\Resources
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Resources|string[] $resources
     *
     * @return $this
     */
    public function setResources($resources)
    {
        $this->resources = $resources instanceof Resources
            ? $resources
            : new Resources($resources);

        return $this;
    }
}
