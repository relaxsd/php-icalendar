<?php

namespace Relaxsd\ICalendar\Properties\ChangeManagement\Traits;

use Relaxsd\ICalendar\Properties\ChangeManagement\SequenceNumber;

/**
 * Trait HasSequenceNumber
 *
 * @see     \Relaxsd\ICalendar\Traits\SequenceNumber
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasSequenceNumber
{

    /**
     * @var \Relaxsd\ICalendar\Properties\ChangeManagement\SequenceNumber
     */
    protected $sequenceNumber;

    /**
     * @return \Relaxsd\ICalendar\Properties\ChangeManagement\SequenceNumber
     */
    public function getSequenceNumber()
    {
        return $this->sequenceNumber;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\ChangeManagement\SequenceNumber|integer $sequenceNumber
     *
     * @return $this
     */
    public function setSequenceNumber($sequenceNumber)
    {
        $this->sequenceNumber = $sequenceNumber instanceof SequenceNumber
            ? $sequenceNumber
            : new SequenceNumber($sequenceNumber);

        return $this;
    }

}
