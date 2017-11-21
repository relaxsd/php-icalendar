<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Attachment;

/**
 * Trait HasAttachments
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Attachment
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasAttachments
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Attachment[]
     */
    protected $attachments = [];

    /**
     * @return Attachment[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param Attachment $attachment
     *
     * @return $this
     */
    public function addAttachment(Attachment $attachment)
    {
        $this->attachments[] = $attachment;

        return $this;
    }
}
