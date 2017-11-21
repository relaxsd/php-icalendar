<?php

namespace Relaxsd\ICalendar\Values\Traits;

/**
 * Trait HasParamTextValue
 *
 * 4.1 Content Lines
 *
 * ...
 * paramtext  = *SAFE-CHAR
 *
 */
trait HasParamTextValue
{

    /**
     * @var string
     */
    protected $paramText;

    /**
     * @return string
     */
    public function getParamText()
    {
        return $this->paramText;
    }

    /**
     * @param string $paramText
     *
     * @return $this
     */
    public function setParamText($paramText)
    {
        $this->paramText = $paramText;
        return $this;
    }

}
