<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

trait HasTimeZoneIdentifier
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\TimezoneIdentifier
     */
    protected $timezoneIdentifier;

    /**
     * @return \Relaxsd\ICalendar\Parameters\TimezoneIdentifier
     */
    public function getTimezoneIdentifier()
    {
        return $this->timezoneIdentifier;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\TimezoneIdentifier $timezoneIdentifier
     *
     * @return $this
     */
    public function setTimezoneIdentifier($timezoneIdentifier)
    {
        $this->timezoneIdentifier = $timezoneIdentifier;

        return $this;
    }

}
