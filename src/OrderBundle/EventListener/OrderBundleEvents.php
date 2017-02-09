<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 09.02.17
 * Time: 8:49
 */

namespace OrderBundle\EventListener;

/**
 * Class OrderBundleEvents
 *
 * Contains all events throw in the OrderBundle
 *
 * @package OrderBundle\EventListener
 */
final class OrderBundleEvents
{
    /**
     * The QUOTE_CREATED event occurs when User create new Quote product
     *
     * @Event("OrderBundle\Event\QuoteEvent")
     */
    const QUOTE_CREATED = 'quote.create';

    /**
     * The QUOTE_DELETE event occurs when User delete new Quote product
     *
     * @Event("OrderBundle\Event\QuoteEvent")
     */
    const QUOTE_DELETE = 'quote.delete';

    /**
     * The CONFIRM_ORDER event occurs when User send active order for confirm
     *
     * @Event("OrderBundle\Event\SalesEvent")
     */
    const CONFIRM_ORDER = 'confirm.order';
}