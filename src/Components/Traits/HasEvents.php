<?php

namespace Relaxsd\ICalendar\Components\Traits;


use Relaxsd\ICalendar\Components\Event;

/**
 * Trait HasEvents
 *
 * @see     \Relaxsd\ICalendar\Components\Event
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasEvents
{

    /**
     * Event[]
     */
    protected $events = [];

    /**
     * @param \Relaxsd\ICalendar\Components\Event $event
     *
     * @return $this
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * @return \Relaxsd\ICalendar\Components\Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }

}
