<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 09.02.17
 * Time: 8:32
 */

namespace OrderBundle\EventListener;

use OrderBundle\Event\QuoteEvent;
use OrderBundle\Event\SalesEvent;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FlashListener implements EventSubscriberInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * FlashListener constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Define subscriber events
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            OrderBundleEvents::QUOTE_CREATED => 'onFlashCreate',
            OrderBundleEvents::QUOTE_DELETE => 'onFlashDelete',
            OrderBundleEvents::CONFIRM_ORDER => 'onFlashConfirm',
        ];
    }

    /**
     * Create success flash messenger for success create quote product
     *
     * @param QuoteEvent $event
     */
    public function onFlashCreate(QuoteEvent $event)
    {
        $product = $event->getProduct();

        $this->session->getFlashBag()->add('success',
            'Product ' . $product->getName() . ' success added'
        );
    }

    /**
     * Create success flash messenger for success delete exists quote product
     */
    public function onFlashDelete()
    {
        $this->session->getFlashBag()->add('success', 'Product delete success');
    }

    /**
     * Create success flash messenger for confirm user order
     *
     * @param SalesEvent $event
     */
    public function onFlashConfirm(SalesEvent $event)
    {

        $sales = $event->getSales();

        $this->session->getFlashBag()->add('success',
            'We will contact you via telephone ' . $sales->getPhone()
        );
    }
}