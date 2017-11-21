<?php

namespace Relaxsd\ICalendar\Properties\Misc\Traits;

use Relaxsd\ICalendar\Properties\Misc\XProperty;

/**
 * Trait HasXProperties
 *
 * @package Relaxsd\ICalendar\Properties\Misc\Traits
 */
trait HasXProperties
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Misc\XProperty[]
     */
    protected $sProperties = [];

    /**
     * @return \Relaxsd\ICalendar\Properties\Misc\XProperty[]
     */
    public function getXProperties()
    {
        return $this->sProperties;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Misc\XProperty|string $xProperty
     *
     * @return $this
     */
    public function addXProperty($xProperty)
    {
        $this->sProperties[] = $xProperty instanceof XProperty
            ? $xProperty
            : new XProperty($xProperty);

        return $this;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Misc\XProperty[]|string[] $xProperties
     *
     * @return $this
     */
    public function addXProperties($xProperties)
    {
        foreach ($xProperties as $xProperty) {
            $this->addXProperty($xProperty);
        }

        return $this;
    }
}
