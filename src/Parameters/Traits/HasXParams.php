<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

/**
 * Trait HasXParams
 */
trait HasXParams
{

    /**
     * xParams.
     * Note that that values are arrays!
     *
     * @var string[][]
     */
    protected $xParams = [];

    /**
     * @return string[][]
     */
    public function getXParams()
    {
        return $this->xParams;
    }

    /**
     * @param string          $key
     * @param string|string[] $value
     *
     * @return $this
     */
    public function addXParam($key, $value)
    {
        $this->xParams[$key] = (array)$value;

        return $this;
    }

    /**
     * @param array $xParams
     *
     * @return $this
     */
    public function addXParams($xParams)
    {
        foreach ($xParams as $key => $value) {
            $this->addXParam($key, $value);
        }

        return $this;
    }
}
