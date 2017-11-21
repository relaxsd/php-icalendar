<?php

namespace Relaxsd\ICalendar\Components\Traits;

use Relaxsd\ICalendar\Components\Journal;

/**
 * Trait HasJournals
 *
 * @see     \Relaxsd\ICalendar\Components\Journal
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasJournals
{

    /**
     * Journal[]
     */
    protected $journal = [];

    /**
     * @param \Relaxsd\ICalendar\Components\Journal $event
     *
     * @return $this
     */
    public function addJournal(Journal $event)
    {
        $this->journal[] = $event;

        return $this;
    }

    /**
     * @return \Relaxsd\ICalendar\Components\Journal[]
     */
    public function getJournals()
    {
        return $this->journal;
    }

}
