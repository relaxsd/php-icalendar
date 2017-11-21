<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\EmailAlarm;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger;
use Relaxsd\ICalendar\Properties\Descriptive\UriAttachment;
use Relaxsd\ICalendar\Properties\Relationship\Attendee;

class CalendarWriterEmailAlarmTest extends TestCase
{

    /**
     * @var EmailAlarm
     */
    protected $emailAlarm;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->emailAlarm = new EmailAlarm();
        $this->writer     = new ICalendarWriter(['wrap' => 64]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_emailAlarm()
    {
        $this->writer->writeEmailAlarm($this->emailAlarm);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyEmailAlarm.txt', $this->writer->getOutput());
    }

    /**
     * The following example is for a "VALARM" calendar component that
     * specifies an email alarm that will trigger 2 days before the
     * scheduled due date/time of a to-do it is associated with. It does not
     * repeat. The email has a subject, body and attachment link.
     *
     * @test
     */
    public function it_writes_alarm_rfc_example_3()
    {

        $this->emailAlarm
            //->setTrigger(Trigger::createRelative('-P2D'))
            ->setTrigger(RelativeTrigger::forDaysBeforehand(2))
            ->addAttendee(Attendee::forEmail('john_doe@host.com'))
            ->setSummary('*** REMINDER: SEND AGENDA FOR WEEKLY STAFF MEETING ***')
            ->setDescription('A draft agenda needs to be sent out to the attendees to the weekly managers meeting (MGR-LIST). Attached is a pointer the document template for the agenda file.')
            ->setAttachment(UriAttachment::forBinaryUrl('http://host.com/templates/agenda.doc'));

        $this->writer->writeEmailAlarm($this->emailAlarm);

        $this->assertStringEqualsFile(__DIR__ . '/expected/alarm_rfc_example3.txt', $this->writer->getOutput());
    }

}
