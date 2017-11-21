<?php

namespace Relaxsd\ICalendar\Components;

use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Properties\Alarm\Action;
use Relaxsd\ICalendar\Properties\Alarm\Traits\HasRepeatCount;
use Relaxsd\ICalendar\Properties\Alarm\Trigger;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDuration;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasAttachment;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasDescription;
use Relaxsd\ICalendar\Properties\Misc\Traits\HasXProperties;

/**
 * Class AudioAlarm
 *
 * procprop   = 3*(
 *
 * ; the following are all REQUIRED,
 * ; but MUST NOT occur more than once
 *
 * action / attach / trigger /
 *
 * ; 'duration' and 'repeat' are both optional,
 * ; and MUST NOT occur more than once each,
 * ; but if one occurs, so MUST the other
 *
 * duration / repeat /
 *
 * ; 'description' is optional,
 * ; and MUST NOT occur more than once
 *
 * description /
 *
 * ; the following is optional,
 * ; and MAY occur more than once
 *
 * x-prop
 *
 * )
 *
 * @package Relaxsd\ICalendar\Components
 */
class ProcedureAlarm extends Alarm
{
    use HasAttachment,
        HasDuration,
        HasRepeatCount,
        HasDescription,
        HasXProperties;

    /**
     * ProcedureAlarm constructor.
     *
     * @param Trigger|string|null $trigger
     */
    public function __construct($trigger = null)
    {
        parent::__construct(Action::newProcedure(), $trigger);
    }

    function acceptWriter(Writer $formatter)
    {
        $formatter->writeProcedureAlarm($this);
    }

}
