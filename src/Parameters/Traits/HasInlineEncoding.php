<?php

namespace Relaxsd\ICalendar\Parameters\Traits;

use Relaxsd\ICalendar\Parameters\InlineEncoding;

trait HasInlineEncoding
{

    /**
     * @var \Relaxsd\ICalendar\Parameters\InlineEncoding
     */
    protected $inlineEncoding;

    /**
     * @return \Relaxsd\ICalendar\Parameters\InlineEncoding
     */
    public function getInlineEncoding()
    {
        return $this->inlineEncoding;
    }

    /**
     * @param \Relaxsd\ICalendar\Parameters\InlineEncoding|string $inlineEncoding
     *
     * @return HasInlineEncoding
     */
    public function setInlineEncoding($inlineEncoding)
    {
        $this->inlineEncoding = $inlineEncoding instanceof InlineEncoding
            ? $inlineEncoding
            : new InlineEncoding($inlineEncoding);

        return $this;
    }

}
