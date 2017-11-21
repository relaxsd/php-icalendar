<?php

namespace Relaxsd\ICalendar\Values\Traits;

/**
 * Trait HasIanaTokenValue
 *
 * iana-token = 1*(ALPHA / DIGIT / "-")
 * ; iCalendar identifier registered with IANA
 *
 */
trait HasIanaTokenValue
{

    /**
     * @var string
     */
    protected $ianaToken;

    /**
     * @return string
     */
    public function getIanaToken()
    {
        return $this->ianaToken;
    }

    /**
     * @param string $ianaToken
     *
     * @return $this
     */
    public function setIanaToken($ianaToken)
    {
        $this->ianaToken = $ianaToken;
        return $this;
    }

}
