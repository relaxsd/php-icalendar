<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Attachment;

/**
 * Trait HasAttachment
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Attachment
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasAttachment
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Attachment
     */
    protected $attachment;

    /**
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param Attachment $attachment
     *
     * @return $this
     */
    public function setAttachment(Attachment $attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }
}
