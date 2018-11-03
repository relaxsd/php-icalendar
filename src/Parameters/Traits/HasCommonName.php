<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\CommonName;

trait HasCommonName
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\CommonName
     */
    protected $commonName;

    /**
     * @return \Relaxsd\ICalendar\Parameters\CommonName
     */
    public function getCommonName()
    {
        return $this->commonName;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\CommonName|string $commonName
     *
     * @return $this
     */
    public function setCommonName($commonName)
    {
        $this->commonName = $commonName instanceof CommonName
            ? $commonName
            : new CommonName($commonName);

        return $this;
    }

}
