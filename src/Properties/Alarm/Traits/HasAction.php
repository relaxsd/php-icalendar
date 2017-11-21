<?php

namespace Relaxsd\ICalendar\Properties\Alarm\Traits;

use Relaxsd\ICalendar\Properties\Alarm\Action;

/**
 * Trait HasAction
 *
 * @see     \Relaxsd\ICalendar\Properties\Alarm\Action
 *
 * @package Relaxsd\ICalendar\Properties\Alarm\Traits
 */
trait HasAction
{

    /**
     * @var Action
     */
    protected $action;

    /**
     * @return Action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param Action|string $action
     *
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = ($action instanceof Action)
            ? $action
            : new Action($action);

        return $this;
    }

}
