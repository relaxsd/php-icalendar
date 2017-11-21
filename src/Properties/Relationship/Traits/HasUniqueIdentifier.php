<?php

namespace Relaxsd\ICalendar\Properties\Relationship\Traits;

use Relaxsd\ICalendar\Properties\Relationship\UniqueIdentifier;

/**
 * Trait HasUniqueIdentifier
 *
 * @see     \Relaxsd\ICalendar\Properties\Relationship\UniqueIdentifier
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasUniqueIdentifier
{

    /**
     * @var UniqueIdentifier
     */
    protected $uniqueIdentifier;

    /**
     * @return UniqueIdentifier
     */
    public function getUniqueIdentifier()
    {
        return $this->uniqueIdentifier;
    }

    /**
     * @param UniqueIdentifier|string $uniqueIdentifier
     *
     * @return $this
     */
    public function setUniqueIdentifier($uniqueIdentifier)
    {
        $this->uniqueIdentifier = ($uniqueIdentifier instanceof UniqueIdentifier)
            ? $uniqueIdentifier
            : new UniqueIdentifier($uniqueIdentifier);
        return $this;
    }

}
