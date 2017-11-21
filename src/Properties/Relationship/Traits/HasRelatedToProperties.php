<?php

namespace Relaxsd\ICalendar\Properties\Relationship\Traits;

use Relaxsd\ICalendar\Properties\Relationship\RelatedTo;

/**
 * Trait HasRelatedToProperties
 *
 * @see     \Relaxsd\ICalendar\Properties\Relationship\RelatedTo
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasRelatedToProperties
{
    /**
     * @var RelatedTo[]
     */
    protected $relatedTos = [];

    /**
     * @param RelatedTo $relatedTo
     *
     * @return $this
     */
    public function addRelatedTo(RelatedTo $relatedTo)
    {
        $this->relatedTos[] = $relatedTo;

        return $this;
    }

    /**
     * @return RelatedTo[]
     */
    public function getRelatedTos()
    {
        return $this->relatedTos;
    }
}
