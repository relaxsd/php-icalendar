<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\Language;

trait HasLanguage
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\Language
     */
    protected $language;

    /**
     * @return \Relaxsd\ICalendar\Parameters\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\Language|string $language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language instanceof Language
            ? $language
            : new Language($language);

        return $this;
    }

}
