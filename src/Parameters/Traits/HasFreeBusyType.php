<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

trait HasFreeBusyType
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\FreeBusyType
     */
    protected $freeBusyType;

    /**
     * @return \Relaxsd\ICalendar\Parameters\FreeBusyType
     */
    public function getFreeBusyType()
    {
        return $this->freeBusyType;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\FreeBusyType $freeBusyType
     *
     * @return HasFreeBusyType
     */
    public function setFreeBusyType($freeBusyType)
    {
        $this->freeBusyType = $freeBusyType;

        return $this;
    }

}
