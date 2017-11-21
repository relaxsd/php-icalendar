<?php

namespace Relaxsd\ICalendar\Properties\Relationship\Traits;

use Relaxsd\ICalendar\Properties\Relationship\Contact;

/**
 * Trait HasContacts
 *
 * @see     \Relaxsd\ICalendar\Properties\Relationship\Contact
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasContacts
{
    /**
     * @var Contact[]
     */
    protected $contacts = [];

    /**
     * @param Contact $contact
     *
     * @return $this
     */
    public function addContact(Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * @return Contact[]
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
