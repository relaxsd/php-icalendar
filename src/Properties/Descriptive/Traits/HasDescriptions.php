<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Description;

/**
 * Trait HasDescriptions
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Description
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDescriptions
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Description[]
     */
    protected $descriptions = [];

    /**
     * @return Description[]
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param Description|string $description
     *
     * @return $this
     */
    public function addDescription($description)
    {
        $this->descriptions[] = $description instanceof Description
            ? $description
            : new Description($description);

        return $this;
    }

}
