<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\FreeBusy;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\Relationship\Attendee;
use Relaxsd\ICalendar\Properties\Relationship\Organizer;
use Relaxsd\ICalendar\Values\Duration;
use Relaxsd\ICalendar\Values\DurationPeriod;
use Relaxsd\ICalendar\Values\ExplicitPeriod;

class CalendarWriterFreeBusyTest extends TestCase
{

    /**
     * @var FreeBusy
     */
    protected $freeBusy;

    /**
     * @var ICalendarWriter
     */
    protected $writer;

    protected function setUp()
    {
        $this->freeBusy = new FreeBusy();
        $this->writer   = new ICalendarWriter(['wrap' => 64]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_freeBusy()
    {
        $this->writer->writeFreeBusy($this->freeBusy);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyFreeBusy.txt', $this->writer->getOutput());
    }

    /**
     * The following is an example of a "VFREEBUSY" calendar
     * component used to request free or busy time information:
     *
     * @test
     */
    public function it_writes_freeBusy_rfc_example_1()
    {

        $this->freeBusy
            ->setOrganizer(Organizer::forEmail('jane_doe@host1.com'))
            ->addAttendee(Attendee::forEmail('john_public@host2.com'))
            ->setDateTimeStart('1997-10-15 05:00 UTC')
            ->setDateTimeEnd('1997-10-16 05:00 UTC')
            ->setDateTimeStamp('1997-09-01 08:30 UTC');

        $this->writer->writeFreeBusy($this->freeBusy);

        $this->assertStringEqualsFile(__DIR__ . '/expected/freeBusy_rfc_example1.txt', $this->writer->getOutput());
    }

    /**
     * The following is an example of a "VFREEBUSY" calendar component used
     * to reply to the request with busy time information:
     *
     * @test
     */
    public function it_writes_freeBusy_rfc_example_2()
    {

        $this->freeBusy
            ->setOrganizer(Organizer::forEmail('jane_doe@host1.com'))
            ->addAttendee(Attendee::forEmail('john_public@host2.com'))
            ->setDateTimeStamp('1997-09-01 10:00 UTC')
            ->setUrl('http://host2.com/pub/busy/jpublic-01.ifb')
            ->addFreeBusy([
                new DurationPeriod('1997-10-15 05:00 UTC', Duration::forHours(8, 30)),
                new DurationPeriod('1997-10-15 16:00 UTC', Duration::forHours(5, 30)),
                new DurationPeriod('1997-10-15 22:30 UTC', 'PT6H30M'), // Raw syntax
            ])
            ->addComment('This iCalendar file contains busy time information for the next three months.');

        $this->writer->setOption('force-value', true);
        $this->writer->writeFreeBusy($this->freeBusy);

        $this->assertStringEqualsFile(__DIR__ . '/expected/freeBusy_rfc_example2.txt', $this->writer->getOutput());
    }

    /**
     * The following is an example of a "VFREEBUSY" calendar component used
     * to publish busy time information.
     *
     * @test
     */
    public function it_writes_freeBusy_rfc_example_3()
    {

        $this->freeBusy
            // The example doesn't use MAILTO:
            //->setOrganizer(Organizer::forEmail('jsmith@host.com'))
            ->setOrganizer(new Organizer('jsmith@host.com'))
            ->setDateTimeStart('1998-03-13 14:17:11 UTC')
            ->setDateTimeEnd('1998-04-10 14:17:11 UTC')
            ->addFreeBusy(new ExplicitPeriod('1998-03-14 23:30 UTC', '1998-03-15 00:30 UTC'))
            ->addFreeBusy(new ExplicitPeriod('1998-03-16 15:30 UTC', '1998-03-16 16:30 UTC'))
            ->addFreeBusy(new ExplicitPeriod('1998-03-18 03:00 UTC', '1998-03-18 04:00 UTC'))
            ->setUrl('http://www.host.com/calendar/busytime/jsmith.ifb');

        $this->writer->writeFreeBusy($this->freeBusy);

        $this->assertStringEqualsFile(__DIR__ . '/expected/freeBusy_rfc_example3.txt', $this->writer->getOutput());
    }
}
