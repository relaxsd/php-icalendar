<?php

namespace Relaxsd\ICalendar\Components;

use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Properties\Alarm\Action;
use Relaxsd\ICalendar\Properties\Alarm\Traits\HasRepeatCount;
use Relaxsd\ICalendar\Properties\Alarm\Trigger;
use Relaxsd\ICalendar\Properties\DateTime\Traits\HasDuration;
use Relaxsd\ICalendar\Properties\Descriptive\Traits\HasAttachment;
use Relaxsd\ICalendar\Properties\Misc\Traits\HasXProperties;

/**
 * Class AudioAlarm
 *
 * 4.6.6 Alarm Component
 *
 * audioprop  = 2*(
 *
 * ; 'action' and 'trigger' are both REQUIRED,
 * ; but MUST NOT occur more than once
 *
 * action / trigger /
 *
 * ; 'duration' and 'repeat' are both optional,
 * ; and MUST NOT occur more than once each,
 * ; but if one occurs, so MUST the other
 *
 * duration / repeat /
 *
 * ; the following is optional,
 * ; but MUST NOT occur more than once
 *
 * attach /
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
class AudioAlarm extends Alarm
{
    use HasDuration,
        HasRepeatCount,
        HasAttachment,
        HasXProperties;

    /**
     * AudioAlarm constructor.
     *
     * @param Trigger|string|null $trigger
     */
    public function __construct($trigger = null)
    {
        parent::__construct(Action::newAudio(), $trigger);
    }

    function acceptWriter(Writer $formatter)
    {
        $formatter->writeAudioAlarm($this);
    }

}
