<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\Journal;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\DateTime\DateTimeStart;

class CalendarWriterJournalTest extends TestCase
{

    /**
     * @var Journal
     */
    protected $journal;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->journal = new Journal();
        $this->writer  = new ICalendarWriter(['wrap' => 64]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_journal()
    {
        $this->writer->writeJournal($this->journal);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyJournal.txt', $this->writer->getOutput());
    }

    /**
     * @test
     */
    public function it_writes_journal_rfc_example_1()
    {
        $this->journal
            ->setUniqueIdentifier('19970901T130000Z-123405@host.com')
            ->setDateTimeStamp('1997-09-01 13:00 UTC')
            ->setDateTimeStart(DateTimeStart::forDate('1997-03-17 UTC'))
            ->setSummary('Staff meeting minutes')
            ->setDescription(<<<'END'
1. Staff meeting: Participants include Joe, Lisa and Bob. Aurora project plans were reviewed. There is currently no budget reserves for this project. Lisa will escalate to management. Next meeting on Tuesday.
2. Telephone Conference: ABC Corp. sales representative called to discuss new printer. Promised to get us a demo by Friday.
3. Henry Miller (Handsoff Insurance): Car was totaled by tree. Is looking into a loaner car. 654-2323 (tel).
END
            );

        $this->writer->writeJournal($this->journal);

        $this->assertStringEqualsFile(__DIR__ . '/expected/journal_rfc_example1.txt', $this->writer->getOutput());
    }

}
