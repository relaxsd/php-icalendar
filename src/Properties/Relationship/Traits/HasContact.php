<?php

namespace Relaxsd\ICalendar\Properties\Relationship\Traits;

/**
 * Trait HasContact
 *
 * @see     \Relaxsd\ICalendar\Properties\Relationship\Contact
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasContact
{

    protected $contact;

    /**
     * @return \Relaxsd\ICalendar\Properties\Relationship\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Relationship\Contact $contact
     *
     * @return $this
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

}
