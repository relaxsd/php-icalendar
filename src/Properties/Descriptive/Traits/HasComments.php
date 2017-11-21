<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Comment;

/**
 * Trait HasComments
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Comment
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasComments
{
    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Comment[]
     */
    protected $comments = [];

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment|string $comment
     *
     * @return $this
     */
    public function addComment($comment)
    {
        $this->comments[] = $comment instanceof Comment
            ? $comment
            : new Comment($comment);

        return $this;
    }
}
