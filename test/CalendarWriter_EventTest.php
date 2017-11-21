<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\Event;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\DateTime\DateTimeStart;
use Relaxsd\ICalendar\Properties\Descriptive\Classification;
use Relaxsd\ICalendar\Properties\Recurrence\RecurrenceRule;

class CalendarWriterEventTest extends TestCase
{

    /**
     * @var Event
     */
    protected $event;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->event  = new Event('EVENT_ID');
        $this->writer = new ICalendarWriter(['wrap' => 64]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_event()
    {
        $this->writer->writeEvent($this->event);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyEvent.txt', $this->writer->getOutput());
    }

    /**
     * @test
     */
    public function it_writes_event_rfc_example_1()
    {
        $this->event
            ->setUniqueIdentifier('19970901T130000Z-123401@host.com')
            ->setDateTimeStamp('1997-09-01 13:00 UTC')
            ->setDateTimeStart('1997-09-03 16:30 UTC')
            ->setDateTimeEnd('1997-09-03 19:00 UTC')
            ->setSummary('Annual Employee Review')
            ->setClassification(Classification::CLASSIFICATION_PRIVATE)
            ->setCategories(['BUSINESS', 'HUMAN RESOURCES']);

        $this->writer->writeEvent($this->event);

        $this->assertStringEqualsFile(__DIR__ . '/expected/event_rfc_example1.txt', $this->writer->getOutput());
    }

    /**
     * @test
     */
    public function it_writes_event_rfc_example_2()
    {
        $this->event
            ->setUniqueIdentifier('19970901T130000Z-123402@host.com')
            ->setDateTimeStamp('1997-09-01 13:00 UTC')
            ->setDateTimeStart('1997-04-01 16:30 UTC')
            ->setDateTimeEnd('1997-04-02 01:00 UTC')
            ->setSummary('Laurel is in sensitivity awareness class.')
            ->setClassification(Classification::CLASSIFICATION_PUBLIC)
            ->setTimeTransparency('TRANSPARENT')
            ->setCategories(['BUSINESS', 'HUMAN RESOURCES']);

        $this->writer->writeEvent($this->event);

        $this->assertStringEqualsFile(__DIR__ . '/expected/event_rfc_example2.txt', $this->writer->getOutput());
    }

    /**
     * @test
     */
    public function it_writes_event_rfc_example_3()
    {
        $this->event
            ->setUniqueIdentifier('19970901T130000Z-123403@host.com')
            ->setDateTimeStamp('1997-09-01 13:00 UTC')
            ->setDateTimeStart(DateTimeStart::forDate('1997-11-02 UTC'))
            ->setSummary('Our Blissful Anniversary')
            ->setClassification(Classification::CLASSIFICATION_CONFIDENTIAL)
            ->addRecurrenceRule(RecurrenceRule::yearly())
            ->setCategories(['ANNIVERSARY', 'PERSONAL', 'SPECIAL OCCASION']);

        $this->writer->writeEvent($this->event);

        $this->assertStringEqualsFile(__DIR__ . '/expected/event_rfc_example3.txt', $this->writer->getOutput());
    }

}
