<?php

namespace Relaxsd\ICalendar\Properties\Descriptive\Traits;

use Relaxsd\ICalendar\Properties\Descriptive\Categories;

/**
 * Trait HasCategoriesProperty
 *
 * @see     \Relaxsd\ICalendar\Properties\Descriptive\Categories
 *
 * @package Relaxsd\ICalendar\Properties\Descriptive\Traits
 */
trait HasCategoriesProperty
{

    /**
     * @var \Relaxsd\ICalendar\Properties\Descriptive\Categories
     */
    protected $categories;

    /**
     * @return \Relaxsd\ICalendar\Properties\Descriptive\Categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Descriptive\Categories|string[] $categories
     *
     * @return $this
     */
    public function setCategories($categories)
    {
        $this->categories = $categories instanceof Categories
            ? $categories
            : new Categories($categories);

        return $this;
    }
}
