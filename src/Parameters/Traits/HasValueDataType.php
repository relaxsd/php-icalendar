<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\ValueDataType;

trait HasValueDataType
{

    /**
     * @var ValueDataType
     */
    protected $valueDataType;

    /**
     * @return ValueDataType
     */
    public function getValueDataType()
    {
        return $this->valueDataType;
    }

    /**
     * @param ValueDataType|string $valueDataType
     *
     * @return $this
     */
    public function setValueDataType($valueDataType)
    {
        $this->valueDataType = $valueDataType instanceof ValueDataType
            ? $valueDataType
            : new ValueDataType($valueDataType);

        return $this;
    }

}
