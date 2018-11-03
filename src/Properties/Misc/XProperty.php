<?php

namespace Relaxsd\ICalendar\Properties\Misc;

use Relaxsd\ICalendar\Parameters\Traits\HasLanguage;
use Relaxsd\ICalendar\Parameters\Traits\HasXParams;
use Relaxsd\ICalendar\Values\Traits\HasTextValue;

class XProperty
{
    use HasXParams,
        HasLanguage,
        HasTextValue;

    /**
     * @var string
     */
    protected $xName;

    /**
     * XProperty constructor.
     *
     * @param string $xName
     * @param string $text
     */
    public function __construct($xName, $text = null)
    {
        $this->xName = $xName;
        $this->setText($text);
    }

    /**
     * @return string
     */
    public function getXName()
    {
        return $this->xName;
    }

    /**
     * @param string $xName
     *
     * @return $this
     */
    public function setXName($xName)
    {
        $this->xName = $xName;
        return $this;
    }

}
