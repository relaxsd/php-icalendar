<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\ProcedureAlarm;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\Descriptive\UriAttachment;
use Relaxsd\ICalendar\Values\Duration;

class CalendarWriterProcedureAlarmTest extends TestCase
{

    /**
     * @var ProcedureAlarm
     */
    protected $procedureAlarm;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->procedureAlarm = new ProcedureAlarm();
        $this->writer         = new ICalendarWriter(['wrap' => 54]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_procedureAlarm()
    {
        $this->writer->writeProcedureAlarm($this->procedureAlarm);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyProcedureAlarm.txt', $this->writer->getOutput());
    }

    /**
     * The following example is for a "VALARM" calendar component that
     * specifies a procedural alarm that will trigger at a precise date/time
     * and will repeat 23 more times at one hour intervals. The alarm will
     * invoke a procedure file.
     *
     * @test
     */
    public function it_writes_alarm_rfc_example_3()
    {

        $this->procedureAlarm
            ->setTrigger('1998-01-01 05:00 UTC')
            ->setRepeatCount(23)
            ->setDuration(Duration::forHours(1))
            ->setAttachment(UriAttachment::forBinaryUrl('ftp://host.com/novo-procs/felizano.exe'));

        $this->writer->writeProcedureAlarm($this->procedureAlarm);

        $this->assertStringEqualsFile(__DIR__ . '/expected/alarm_rfc_example4.txt', $this->writer->getOutput());
    }

}
