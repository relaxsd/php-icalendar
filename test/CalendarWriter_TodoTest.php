<?php

use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\Todo;
use Relaxsd\ICalendar\Contracts\Writer;
use Relaxsd\ICalendar\Formatter\ICalendarWriter;
use Relaxsd\ICalendar\Properties\Descriptive\Classification;
use Relaxsd\ICalendar\Properties\Descriptive\Status;

class CalendarWriterTodoTest extends TestCase
{

    /**
     * @var Todo
     */
    protected $todo;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->todo  = new Todo();
        $this->writer = new ICalendarWriter(['wrap' => 64]);
    }

    /**
     * @test
     */
    public function it_writes_an_empty_todo()
    {
        $this->writer->writeTodo($this->todo);
        $this->assertStringEqualsFile(__DIR__ . '/expected/emptyTodo.txt', $this->writer->getOutput());
    }

    /**
     * @test
     */
    public function it_writes_todo_rfc_example_1()
    {
        $this->todo
            ->setUniqueIdentifier('19970901T130000Z-123404@host.com')
            ->setDateTimeStamp('1997-09-01 13:00 UTC')
            ->setDateTimeStart('1997-04-15 13:30 UTC')
            ->setDateTimeDue('1997-04-16 04:59:59 UTC')
            ->setSummary('1996 Income Tax Preparation')
            ->setClassification(Classification::CLASSIFICATION_CONFIDENTIAL)
            ->setCategories(['FAMILY', 'FINANCE'])
            ->setPriority(1)
            ->setStatus(Status::STATUS_NEEDS_ACTION);

        $this->writer->writeTodo($this->todo);

        $this->assertStringEqualsFile(__DIR__ . '/expected/todo_rfc_example1.txt', $this->writer->getOutput());
    }

}
