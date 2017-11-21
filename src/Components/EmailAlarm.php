<?php

namespace Relaxsd\ICalendar\Components;

use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Properties\Alarm\Action;
use Relaxsd\ICalendar\Properties\Alarm\Traits\HasRepeatCount;
use Relaxsd\ICalendar\Properties\Alarm\Trigger;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDuration;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasAttachment;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasDescription;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasSummary;
use Relaxsd\ICalendar\Properties\Misc\Traits\HasXProperties;
use Relaxsd\ICalendar\Properties\Relationship\Traits\HasAttendees;

/**
 * Class EmailAlarm
 *
 * emailprop  = 5*(
 *
 * ; the following are all REQUIRED,
 * ; but MUST NOT occur more than once
 *
 * action / description / trigger / summary
 *
 * ; the following is REQUIRED,
 * ; and MAY occur more than once
 *
 * attendee /
 *
 * ; 'duration' and 'repeat' are both optional,
 * ; and MUST NOT occur more than once each,
 * ; but if one occurs, so MUST the other
 *
 * duration / repeat /
 *
 * ; the following are optional,
 * ; and MAY occur more than once
 *
 * attach / x-prop
 *
 * )
 *
 * @package Relaxsd\ICalendar\Components
 */
class EmailAlarm extends Alarm
{
    use HasDescription,
        HasSummary,
        HasAttendees,
        HasDuration,
        HasRepeatCount,
        HasAttachment,
        HasXProperties;

    /**
     * EmailAlarm constructor.
     *
     * @param Trigger|string|null $trigger
     */
    public function __construct($trigger = null)
    {
        parent::__construct(Action::newEmail(), $trigger);
    }

    function acceptWriter(Writer $formatter)
    {
        $formatter->writeEmailAlarm($this);
    }

}
