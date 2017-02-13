<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 09.02.17
 * Time: 8:55
 */

namespace OrderBundle\Event;

use ProductBundle\Entity\Product;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class QuoteEvent
 * @package OrderBundle\Event
 */
class QuoteEvent extends Event
{
    /**
     * @var Product
     */
    private $product;

    /**
     * QuoteEvent constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}