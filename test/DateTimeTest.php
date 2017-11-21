<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\DateTime\DateTimeStart;

class StartDateVersionTest extends TestCase
{

    /**
     * @var \Relaxsd\ICalendar\Properties\DateTime\DateTimeStart
     */
    protected $startDate;

    /**
     * @var ICalendarWriter
     */
    protected $writer;

    protected function setUp()
    {
        $this->startDate = new DateTimeStart();
        $this->writer    = new ICalendarWriter();
    }

    /**
     * @test
     */
    public function it_writes_utc_times()
    {
        $this->assertEquals("DTSTART:20171231T123456Z\n", $this->writeDateTimeStartProperty(new DateTime('2017-12-31 12:34:56 UTC')));
    }

    /**
     * @test
     */
    public function it_ignore_timezone_hours()
    {
        $this->assertEquals("DTSTART:20171231T123456\n", $this->writeDateTimeStartProperty(new DateTime('2017-12-31 12:34:56+13:00')));
    }

    /**
     * @test
     */
    public function it_adds_timezones()
    {
        $this->assertEquals("DTSTART:20171231T000000\n", $this->writeDateTimeStartProperty(new DateTime('2017-12-31', new DateTimeZone('Pacific/Nauru'))));
    }

    /**
     * @param DateTime $dateTime
     *
     * @return string
     */
    protected function writeDateTimeStartProperty($dateTime)
    {
        self
            ::getWriterMethod('writeDateTimeStartProperty')
            ->invokeArgs($this->writer, [New DateTimeStart($dateTime)]);

        return $this->writer->getOutput();
    }

    protected static function getWriterMethod($name)
    {
        $class  = new ReflectionClass('Relaxsd\\ICalendar\\Formatter\\ICalendarWriter');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

}
