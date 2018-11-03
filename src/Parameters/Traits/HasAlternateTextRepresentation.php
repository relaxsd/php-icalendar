<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\AlternateTextRepresentation;

trait HasAlternateTextRepresentation
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\AlternateTextRepresentation
     */
    protected $alternateTextRepresentation;

    /**
     * @return \Relaxsd\ICalendar\Parameters\AlternateTextRepresentation
     */
    public function getAlternateTextRepresentation()
    {
        return $this->alternateTextRepresentation;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\AlternateTextRepresentation|string[][] $alternateTextRepresentation
     *
     * @return $this
     */
    public function setAlternateTextRepresentation($alternateTextRepresentation)
    {
        $this->alternateTextRepresentation = $alternateTextRepresentation instanceof AlternateTextRepresentation
            ? $alternateTextRepresentation
            : new AlternateTextRepresentation($alternateTextRepresentation);

        return $this;
    }

}
