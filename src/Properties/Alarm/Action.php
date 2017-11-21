<?php

namespace Relaxsd\ICalendar\Properties\Alarm;

use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class Action
 *
 * 4.8.6.1 Action
 *
 * Property Name: ACTION
 *
 * Purpose: This property defines the action to be invoked when an alarm
 * is triggered.
 *
 * Value Type: TEXT
 *
 * Property Parameters: Non-standard property parameters can be
 * specified on this property.
 *
 * Conformance: This property MUST be specified once in a "VALARM"
 * calendar component.
 *
 * Description: Each "VALARM" calendar component has a particular type
 * of action associated with it. This property specifies the type of
 * action
 *
 * Format Definition: The property is defined by the following notation:
 *
 * action     = "ACTION" actionparam ":" actionvalue CRLF
 *
 * actionparam        = *(";" xparam)
 *
 * actionvalue        = "AUDIO" / "DISPLAY" / "EMAIL" / "PROCEDURE"
 * / iana-token / x-name
 *
 * Example: The following are examples of this property in a "VALARM"
 * calendar component:
 *
 * ACTION:AUDIO
 *
 * ACTION:DISPLAY
 *
 * ACTION:PROCEDURE
 */
class Action
{
    use HasXParams,
        HasValue;

    const  ACTION_AUDIO = "AUDIO";
    const  ACTION_DISPLAY = "DISPLAY";
    const  ACTION_EMAIL = "EMAIL";
    const  ACTION_PROCEDURE = "PROCEDURE";
    // iana-token
    // x-name

    /**
     * Action constructor.
     *
     * @param string $action
     */
    public function __construct($action)
    {
        $this->setValue($action);
    }

    public static function newAudio()
    {
        return new self(self::ACTION_AUDIO);
    }

    public static function newDisplay()
    {
        return new self(self::ACTION_DISPLAY);
    }

    public static function newEmail()
    {
        return new self(self::ACTION_EMAIL);
    }

    public static function newProcedure()
    {
        return new self(self::ACTION_PROCEDURE);
    }

}
