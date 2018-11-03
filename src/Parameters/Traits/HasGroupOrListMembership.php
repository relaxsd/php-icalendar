<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\GroupOrListMembership;

trait HasGroupOrListMembership
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\GroupOrListMembership
     */
    protected $groupOrListMembership;

    /**
     * @return \Relaxsd\ICalendar\Parameters\GroupOrListMembership
     */
    public function getGroupOrListMembership()
    {
        return $this->groupOrListMembership;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\GroupOrListMembership|string[]|string $groupOrListMembership
     *
     * @return $this
     */
    public function setGroupOrListMembership($groupOrListMembership)
    {
        $this->groupOrListMembership = $groupOrListMembership instanceof GroupOrListMembership
            ? $groupOrListMembership
            : new GroupOrListMembership($groupOrListMembership);

        return $this;
    }

}
