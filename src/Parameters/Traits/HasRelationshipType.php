<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\RelationshipType;

trait HasRelationshipType
{

    /**
     * @var RelationshipType
     */
    protected $relationshipType;

    /**
     * @return RelationshipType
     */
    public function getRelationshipType()
    {
        return $this->relationshipType;
    }

    /**
     * @param RelationshipType $relationshipType
     *
     * @return HasRelationshipType
     */
    public function setRelationshipType($relationshipType)
    {
        $this->relationshipType = $relationshipType;

        return $this;
    }

}
