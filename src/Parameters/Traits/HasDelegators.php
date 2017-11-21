<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\Delegators;

trait HasDelegators
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\Delegators
     */
    protected $delegators;

    /**
     * @return \Relaxsd\ICalendar\Parameters\Delegators
     */
    public function getDelegators()
    {
        return $this->delegators;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\Delegators|string[][] $delegators
     *
     * @return HasDelegators
     */
    public function setDelegators($delegators)
    {
        $this->delegators = $delegators instanceof Delegators
            ? $delegators
            : new Delegators($delegators);

        return $this;
    }

}
