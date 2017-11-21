<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\DisplayAlarm;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\Alarm\RelativeTrigger;
use Relaxsd\ICalendar\Properties\DateTime\Duration;

class CalendarWriterDisplayAlarmTest extends TestCase
{

    /**
     * @var DisplayAlarm
     */
    protected $displayAlarm;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->displayAlarm = new DisplayAlarm();
        $this->writer       = new ICalendarWriter(['wrap' => 64]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_displayAlarm()
    {
        $this->writer->writeDisplayAlarm($this->displayAlarm);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyDisplayAlarm.txt', $this->writer->getOutput());
    }

    /**
     * The following example is for a "VALARM" calendar component that
     * specifies a display alarm that will trigger 30 minutes before the
     * scheduled start of the event or the due date/time of the to-do it is
     * associated with and will repeat 2 more times at 15 minute intervals:
     *
     * @test
     */
    public function it_writes_alarm_rfc_example_2()
    {

        $this->displayAlarm
            //->setTrigger(Trigger::createRelative('-PT30M'))
            ->setTrigger(RelativeTrigger::forMinutesBeforehand(30))
            ->setRepeatCount(2)
            ->setDuration(Duration::forMinutes(15))
            ->setDescription(<<<'END'
Breakfast meeting with executive
team at 8:30 AM EST.
END
            );

        $this->writer->writeDisplayAlarm($this->displayAlarm);

        $this->assertStringEqualsFile(__DIR__ . '/expected/alarm_rfc_example2.txt', $this->writer->getOutput());
    }

}
