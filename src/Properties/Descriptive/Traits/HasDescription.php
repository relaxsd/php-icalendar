<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Description;

/**
 * Trait HasDescription
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Description
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasDescription
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Description
     */
    protected $description;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Description|string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description instanceof Description
            ? $description
            : new Description($description);

        return $this;
    }

}
