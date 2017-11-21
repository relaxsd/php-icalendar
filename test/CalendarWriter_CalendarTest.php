<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\Calendar;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;

class CalendarWriterCalendarTest extends TestCase
{

    /**
     * @var Calendar
     */
    protected $calendar;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->calendar = new Calendar();
        $this->writer   = new ICalendarWriter(['wrap' => 64]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_calendar()
    {
        $this->writer->writeCalendar($this->calendar);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyCalendar.txt', $this->writer->getOutput());
    }

}
