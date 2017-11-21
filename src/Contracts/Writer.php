<?php

namespace Relaxsd\ICalendar\Contracts;

use Relaxsd\ICalendar\Components\AudioAlarm;
use Relaxsd\ICalendar\Components\Calendar;
use Relaxsd\ICalendar\Components\DisplayAlarm;
use Relaxsd\ICalendar\Components\EmailAlarm;
use Relaxsd\ICalendar\Components\Event;
use Relaxsd\ICalendar\Components\FreeBusy;
use Relaxsd\ICalendar\Components\Journal;
use Relaxsd\ICalendar\Components\ProcedureAlarm;
use Relaxsd\ICalendar\Components\TimeZone;
use Relaxsd\ICalendar\Components\Todo;

interface Writer
{

    public function writeCalendar(Calendar $calendar);

    public function writeEvent(Event $event);

    public function writeTodo(Todo $todo);

    public function writeAudioAlarm(AudioAlarm $alarm);

    public function writeDisplayAlarm(DisplayAlarm $alarm);

    public function writeEmailAlarm(EmailAlarm $alarm);

    public function writeProcedureAlarm(ProcedureAlarm $alarm);

    public function writeJournal(Journal $journal);

    public function writeFreeBusy(FreeBusy $freeBusy);

    public function writeTimeZone(TimeZone $timeZone);

    /**
     * @return string
     */
    public function getOutput();

}
