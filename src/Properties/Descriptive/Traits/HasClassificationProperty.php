<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Classification;

/**
 * Trait HasClassificationProperty
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Classification
 *
 * @package Relaxsd\ICalendar\Properties\Descriptive\Traits
 */
trait HasClassificationProperty
{

    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Classification
     */
    protected $classification;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\Classification
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Classification|string $classification
     *
     * @return $this
     */
    public function setClassification($classification)
    {
        $this->classification = ($classification instanceof Classification)
            ? $classification
            : new Classification($classification);

        return $this;
    }
}
