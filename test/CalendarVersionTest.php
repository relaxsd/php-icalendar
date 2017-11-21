<?php
use PHPUnit\Framework\TestCase;
use Relaxsd\ICalendar\Components\Calendar;

class CalendarVersionTest extends TestCase
{

    /**
     * @var Calendar
     */
    protected $calendar;

    protected function setUp()
    {
        $this->calendar = new Calendar();
    }

    /**
     * @test
     */
    public function it_has_a_default_version()
    {

        $this->assertEquals('2.0', $this->calendar->getVersion()->getVersion());
        $this->assertNull($this->calendar->getVersion()->getMinVersion());
        $this->assertNull($this->calendar->getVersion()->getMaxVersion());
        $this->assertEquals('2.0', (string)$this->calendar->getVersion());
    }

    /**
     * @test
     */
    public function its_constructor_supports_a_version()
    {
        $newCalendar = new Calendar('3.1');
        $this->assertNull($newCalendar->getVersion()->getMinVersion());
        $this->assertNull($newCalendar->getVersion()->getMaxVersion());
        $this->assertEquals('3.1', (string)$newCalendar->getVersion());
    }

    /**
     * @test
     */
    public function its_constructor_supports_a_min_max_version()
    {
        $newCalendar = new Calendar('3.0', '4.0');
        $this->assertNull($newCalendar->getVersion()->getVersion());
        $this->assertEquals('3.0', $newCalendar->getVersion()->getMinVersion());
        $this->assertEquals('4.0', $newCalendar->getVersion()->getMaxVersion());

        $this->assertEquals('3.0;4.0', (string)$newCalendar->getVersion());
    }

    /**
     * @test
     */
    public function it_supports_a_version()
    {
        $this->calendar->setVersion('3.1');
        $this->assertEquals('3.1', $this->calendar->getVersion()->getVersion());
        $this->assertEquals('3.1', (string)$this->calendar->getVersion());
    }

    /**
     * @test
     */
    public function it_supports_a_min_max_version()
    {
        $this->calendar->setVersion('3.0', '4.0');
        $this->assertNull($this->calendar->getVersion()->getVersion());
        $this->assertEquals('3.0', $this->calendar->getVersion()->getMinVersion());
        $this->assertEquals('4.0', $this->calendar->getVersion()->getMaxVersion());

        $this->assertEquals('3.0;4.0', (string)$this->calendar->getVersion());
    }

}
