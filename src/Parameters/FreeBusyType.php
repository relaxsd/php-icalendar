<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class FreeBusy
 *
 * 4.2.9 Free/Busy Time Type
 *
 * Parameter Name: FBTYPE
 *
 * Purpose: To specify the free or busy time type.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * fbtypeparam        = "FBTYPE" "=" ("FREE" / "BUSY"
 * / "BUSY-UNAVAILABLE" / "BUSY-TENTATIVE"
 * / x-name
 * ; Some experimental iCalendar data type.
 * / iana-token)
 * ; Some other IANA registered iCalendar data type.
 *
 * Description: The parameter specifies the free or busy time type. The
 * value FREE indicates that the time interval is free for scheduling.
 * The value BUSY indicates that the time interval is busy because one
 * or more events have been scheduled for that interval. The value
 * BUSY-UNAVAILABLE indicates that the time interval is busy and that
 * the interval can not be scheduled. The value BUSY-TENTATIVE indicates
 * that the time interval is busy because one or more events have been
 * tentatively scheduled for that interval. If not specified on a
 * property that allows this parameter, the default is BUSY.
 *
 * Example: The following is an example of this parameter on a FREEBUSY
 * property.
 *
 * FREEBUSY;FBTYPE=BUSY:19980415T133000Z/19980415T170000Z
 *
 * @package Relaxsd\ICalendar\Parameters
 */
class FreeBusyType
{
    use HasValue;

    const FBTYPE_FREE = 'FREE';
    const FBTYPE_BUSY = 'BUSY';
    const FBTYPE_BUSY_UNAVAILABLE = 'BUSY-UNAVAILABLE';
    const FBTYPE_BUSY_TENTATIVE = 'BUSY-TENTATIVE';
    // x-name // Some experimental iCalendar data type.
    // iana-token

    /**
     * FreeBusyType constructor.
     *
     * @param string $freeBusyType
     */
    public function __construct($freeBusyType)
    {
        $this->setValue($freeBusyType);
    }

    /**
     * @param FreeBusyType|string $freeBusyType
     *
     * @return string
     */
    public static function valueOf($freeBusyType)
    {
        if (!isset($freeBusyType)) return null;

        return $freeBusyType instanceof FreeBusyType ? $freeBusyType->getValue() : $freeBusyType;
    }

}
