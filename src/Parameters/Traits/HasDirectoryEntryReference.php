<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\DirectoryEntryReference;

trait HasDirectoryEntryReference
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\DirectoryEntryReference
     */
    protected $directoryEntryReference;

    /**
     * @return \Relaxsd\ICalendar\Parameters\DirectoryEntryReference
     */
    public function getDirectoryEntryReference()
    {
        return $this->directoryEntryReference;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\DirectoryEntryReference|string $directoryEntryReference
     *
     * @return $this
     */
    public function setDirectoryEntryReference($directoryEntryReference)
    {
        $this->directoryEntryReference = $directoryEntryReference instanceof DirectoryEntryReference
            ? $directoryEntryReference
            : new DirectoryEntryReference($directoryEntryReference);

        return $this;
    }

}
