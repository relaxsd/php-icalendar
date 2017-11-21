<?php

namespace Relaxsd\ICalendar\Properties\Calendar\Traits;

use Relaxsd\ICalendar\Properties\Calendar\ProductIdentifier;

/**
 * Trait HasProductIdentifier
 *
 * @see     \Relaxsd\ICalendar\Properties\Calendar\ProductIdentifier
 *
 * @package Relaxsd\ICalendar\Properties\Calendar\Traits
 */
trait HasProductIdentifier
{

    /** @var  \Relaxsd\ICalendar\Properties\Calendar\ProductIdentifier */
    protected $productIdentifier;

    /**
     * @return ProductIdentifier
     */
    public function getProductIdentifier()
    {
        return $this->productIdentifier;
    }

    /**
     * @param \Relaxsd\ICalendar\Properties\Calendar\ProductIdentifier|string $productIdentifier
     *
     * @return $this
     */
    public function setProductIdentifier($productIdentifier)
    {
        $this->productIdentifier = ($productIdentifier instanceof ProductIdentifier)
            ? $productIdentifier
            : new ProductIdentifier($productIdentifier);

        return $this;
    }

}
