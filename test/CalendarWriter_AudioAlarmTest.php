<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\AudioAlarm;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\DateTime\Duration;
use Relaxsd\ICalendar\Properties\Descriptive\UriAttachment;

class CalendarWriterAudioAlarmTest extends TestCase
{

    /**
     * @var AudioAlarm
     */
    protected $audioAlarm;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->audioAlarm = new AudioAlarm();
        $this->writer     = new ICalendarWriter(['wrap' => 64]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_audioAlarm()
    {
        $this->writer->writeAudioAlarm($this->audioAlarm);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyAudioAlarm.txt', $this->writer->getOutput());
    }

    /**
     * The following example is for a "VALARM" calendar component
     * that specifies an audio alarm that will sound at a precise time and
     * repeat 4 more times at 15 minute intervals:
     *
     * @test
     */
    public function it_writes_alarm_rfc_example_1()
    {

        $this->audioAlarm
            ->setTrigger('1997-03-17 13:30 UTC')
            ->setRepeatCount(4)
            ->setAttachment(UriAttachment::forAudioUrl('ftp://host.com/pub/sounds/bell-01.aud'))
            ->setDuration(Duration::forMinutes(15));

        $this->writer->writeAudioAlarm($this->audioAlarm);

        $this->assertStringEqualsFile(__DIR__ . '/expected/alarm_rfc_example1.txt', $this->writer->getOutput());
    }

}
