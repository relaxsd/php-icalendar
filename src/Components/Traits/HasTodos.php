<?php

namespace Relaxsd\ICalendar\Components\Traits;

use Relaxsd\ICalendar\Components\Todo;

/**
 * Trait HasTodos
 *
 * @see     \Relaxsd\ICalendar\Components\Todo
 *
 * @package Relaxsd\ICalendar\Traits
 */
trait HasTodos
{

    /**
     * Todo[]
     */
    protected $todos = [];

    /**
     * @param \Relaxsd\ICalendar\Components\Todo $todo
     *
     * @return $this
     */
    public function addTodo(Todo $todo)
    {
        $this->todos[] = $todo;

        return $this;
    }

    /**
     * @return \Relaxsd\ICalendar\Components\Todo[]
     */
    public function getTodos()
    {
        return $this->todos;
    }

}
