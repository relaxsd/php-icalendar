<?php

namespace Relaxsd\ICalendar\Properties\Relationship\Traits;

/**
 * Trait HasOrganizer
 *
 * @see     \Relaxsd\ICalendar\Properties\Relationship\Organizer
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasOrganizer
{

    protected $organizer;

    /**
     * @return \Relaxsd\ICalendar\Properties\Relationship\Organizer
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Organizer $organizer
     *
     * @return $this
     */
    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
        return $this;
    }

}
