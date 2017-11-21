<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\SentBy;

trait HasSentBy
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\SentBy
     */
    protected $sentBy;

    /**
     * @return \Relaxsd\ICalendar\Parameters\SentBy
     */
    public function getSentBy()
    {
        return $this->sentBy;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\SentBy|string $sentBy
     *
     * @return HasSentBy
     */
    public function setSentBy($sentBy)
    {
        $this->sentBy = $sentBy instanceof SentBy
            ? $sentBy
            : new SentBy($sentBy);

        return $this;
    }

}
