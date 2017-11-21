<?php

namespace Relaxsd\ICalendar\Properties\Relationship\Traits;

use Relaxsd\ICalendar\Properties\Relationship\Url;

/**
 * Trait HasUrl
 *
 * @see     \Relaxsd\ICalendar\Properties\Relationship\Url
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasUrl
{

    protected $url;

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param Url|string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url instanceof Url
            ? $url
            : new Url($url);

        return $this;
    }

}
