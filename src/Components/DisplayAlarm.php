<?php

namespace Relaxsd\ICalendar\Components;

use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Properties\Alarm\Action;
use Relaxsd\ICalendar\Properties\Alarm\Traits\HasRepeatCount;
use Relaxsd\ICalendar\Properties\Alarm\Trigger;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDuration;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasDescription;
use Relaxsd\ICalendar\Properties\Misc\Traits\HasXProperties;

/**
 * Class AudioAlarm
 *
 * 4.6.6 Alarm Component
 *
 * dispprop   = 3*(
 *
 * ; the following are all REQUIRED,
 * ; but MUST NOT occur more than once
 *
 * action / description / trigger /
 *
 * ; 'duration' and 'repeat' are both optional,
 * ; and MUST NOT occur more than once each,
 * ; but if one occurs, so MUST the other
 *
 * duration / repeat /
 *
 * ; the following is optional,
 *
 * ; and MAY occur more than once
 *x-prop
 *
 * )
 *
 * @package Relaxsd\ICalendar\Components
 */
class DisplayAlarm extends Alarm
{
    use HasDescription,
        HasDuration,
        HasRepeatCount,
        HasXProperties;

    /**
     * DisplayAlarm constructor.
     *
     * @param Trigger|string|null $trigger
     */
    public function __construct($trigger = null)
    {
        parent::__construct(Action::newDisplay(), $trigger);
    }

    function acceptWriter(Writer $formatter)
    {
        $formatter->writeDisplayAlarm($this);
    }

}
