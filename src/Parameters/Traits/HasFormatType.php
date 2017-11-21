<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\FormatType;

/**
 * Trait HasFormatType
 *
 * @see     \Relaxsd\ICalendar\Parameters\FormatType
 *
 * @package Relaxsd\ICalendar\Parameters\Traits
 */
trait HasFormatType
{

    /**
     * @var FormatType
     */
    protected $formatType;

    /**
     * @return FormatType
     */
    public function getFormatType()
    {
        return $this->formatType;
    }

    /**
     * @param FormatType|string $formatType
     *
     * @return $this
     */
    public function setFormatType($formatType)
    {
        $this->formatType = $formatType instanceof FormatType
            ? $formatType
            : new FormatType($formatType);

        return $this;
    }

}
