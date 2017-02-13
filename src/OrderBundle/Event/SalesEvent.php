<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 09.02.17
 * Time: 15:48
 */

namespace OrderBundle\Event;

use OrderBundle\Entity\Sales;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class SalesEvent
 * @package OrderBundle\Event
 */
class SalesEvent extends Event
{
    /**
     * @var Sales
     */
    private $sales;

    /**
     * SalesEvent constructor.
     *
     * @param Sales $sales
     */
    public function __construct(Sales $sales)
    {
        $this->sales = $sales;
    }

    /**
     * @return Sales
     */
    public function getSales()
    {
        return $this->sales;
    }
}
