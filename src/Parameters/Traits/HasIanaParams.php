<?php

namespace Relaxsd\ICalendar\Traits;

/**
 * Trait HasIanaParams
 */
trait HasIanaParams
{

    /**
     * ianaParams.
     * Note that that values are arrays!
     *
     * @var string[][]
     */
    protected $ianaParams = [];

    /**
     * @return string[][]
     */
    public function getIanaParams()
    {
        return $this->ianaParams;
    }

    /**
     * @param string          $key
     * @param string|string[] $value
     *
     * @return $this
     */
    public function addIanaParam($key, $value)
    {
        $this->ianaParams[$key] = (array)$value;

        return $this;
    }

    /**
     * @param array $ianaParams
     *
     * @return $this
     */
    public function addIanaParams($ianaParams)
    {
        foreach ($ianaParams as $key => $value) {
            $this->addIanaParam($key, $value);
        }

        return $this;
    }
}
