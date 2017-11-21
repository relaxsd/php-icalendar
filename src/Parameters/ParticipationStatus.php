<?php

namespace Relaxsd\ICalendar\Parameters;

use Relaxsd\ICalendar\Values\Traits\HasValue;

/**
 * Class ParticipationStatus
 *
 * 4.2.12 Participation Status
 *
 * Parameter Name: PARTSTAT
 *
 * Purpose: To specify the participation status for the calendar user
 * specified by the property.
 *
 * Format Definition: The property parameter is defined by the following
 * notation:
 *
 * partstatparam      = "PARTSTAT" "="
 * ("NEEDS-ACTION"        ; Event needs action
 * / "ACCEPTED"            ; Event accepted
 * / "DECLINED"            ; Event declined
 * / "TENTATIVE"           ; Event tentatively
 * ; accepted
 * / "DELEGATED"           ; Event delegated
 * / x-name                ; Experimental status
 * / iana-token)           ; Other IANA registered
 * ; status
 * ; These are the participation statuses for a "VEVENT". Default is
 * ; NEEDS-ACTION
 *
 * partstatparam      /= "PARTSTAT" "="
 * ("NEEDS-ACTION"        ; To-do needs action
 * / "ACCEPTED"            ; To-do accepted
 * / "DECLINED"            ; To-do declined
 * / "TENTATIVE"           ; To-do tentatively
 * ; accepted
 * / "DELEGATED"           ; To-do delegated
 * / "COMPLETED"           ; To-do completed.
 * ; COMPLETED property has
 * ;date/time completed.
 * / "IN-PROCESS"          ; To-do in process of
 * ; being completed
 * / x-name                ; Experimental status
 * / iana-token)           ; Other IANA registered
 * ; status
 * ; These are the participation statuses for a "VTODO". Default is
 * ; NEEDS-ACTION
 *
 * partstatparam      /= "PARTSTAT" "="
 * ("NEEDS-ACTION"        ; Journal needs action
 * / "ACCEPTED"            ; Journal accepted
 * / "DECLINED"            ; Journal declined
 * / x-name                ; Experimental status
 * / iana-token)           ; Other IANA registered
 * ; status
 * ; These are the participation statuses for a "VJOURNAL". Default is
 * ; NEEDS-ACTION
 *
 * Description: This parameter can be specified on properties with a
 * CAL-ADDRESS value type. The parameter identifies the participation
 * status for the calendar user specified by the property value. The
 * parameter values differ depending on whether they are associated with
 * a group scheduled "VEVENT", "VTODO" or "VJOURNAL". The values MUST
 * match one of the values allowed for the given calendar component. If
 * not specified on a property that allows this parameter, the default
 * value is NEEDS-ACTION.
 *
 * Example:
 *
 * ATTENDEE;PARTSTAT=DECLINED:MAILTO:jsmith@host.com
 *
 * @package Relaxsd\ICalendar\Contracts
 */
class ParticipationStatus
{

    use HasValue;

    const PARTSTAT_NEEDS_ACTION = "NEEDS-ACTION";
    const PARTSTAT_ACCEPTED = "ACCEPTED";
    const PARTSTAT_DECLINED = "DECLINED";
    const PARTSTAT_TENTATIVE = "TENTATIVE";
    const PARTSTAT_DELEGATED = "DELEGATED";
    const PARTSTAT_COMPLETED = "COMPLETED";
    const PARTSTAT_IN_PROCESS = "IN-PROCESS";
    // x-name                ; Experimental status
    // iana-token)           ; Other IANA registered status

    // These are the participation statuses for a "VEVENT".
    // Default is; NEEDS-ACTION
    const EVENT_PARTSTATS = [
        self::PARTSTAT_NEEDS_ACTION,
        self::PARTSTAT_ACCEPTED,
        self::PARTSTAT_DECLINED,
        self::PARTSTAT_TENTATIVE,
        self::PARTSTAT_DELEGATED,
        // x-name                ; Experimental status
        // iana-token)           ; Other IANA registered status
    ];

    // These are the participation statuses for a "VTODO".
    // Default is NEEDS-ACTION
    const TODO_PARTSTATS = [
        self::PARTSTAT_NEEDS_ACTION,
        self::PARTSTAT_ACCEPTED,
        self::PARTSTAT_DECLINED,
        self::PARTSTAT_TENTATIVE,
        self::PARTSTAT_DELEGATED,
        self::PARTSTAT_COMPLETED,
        self::PARTSTAT_IN_PROCESS,
        // x-name                ; Experimental status
        // iana-token)           ; Other IANA registered status
    ];

    // These are the participation statuses for a "VJOURNAL".
    // Default is NEEDS-ACTION
    const JOURNAL_PARTSTATS = [
        self::PARTSTAT_NEEDS_ACTION,
        self::PARTSTAT_ACCEPTED,
        self::PARTSTAT_DECLINED,
        // x-name                ; Experimental status
        // iana-token)           ; Other IANA registered status
    ];

    /**
     * ParticipationStatus constructor.
     *
     * @param string $participationStatus
     */
    public function __construct($participationStatus)
    {
        $this->setValue($participationStatus);
    }

}
