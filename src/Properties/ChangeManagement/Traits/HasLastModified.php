<?php

namespace Relaxsd\ICalendar\Properties\ChangeManagement\Traits;

use Relaxsd\ICalendar\Properties\ChangeManagement\LastModified;

/**
 * Trait HasLastModified
 *
 * @see     \Relaxsd\ICalendar\Properties\DateTime\LastModified
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasLastModified
{

    /**
     * @var \Relaxsd\ICalendar\Properties\ChangeManagement\LastModified
     */
    protected $lastModified;

    /**
     * @return \Relaxsd\ICalendar\Properties\ChangeManagement\LastModified
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\LastModified|\DateTime|string $lastModified
     *
     * @return $this
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = ($lastModified instanceof LastModified)
            ? $lastModified
            : new LastModified($lastModified);

        return $this;
    }

}
