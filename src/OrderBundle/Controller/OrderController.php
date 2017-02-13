<?php

namespace OrderBundle\Controller;

use OrderBundle\Event\QuoteEvent;
use OrderBundle\Event\SalesEvent;
use OrderBundle\EventListener\OrderBundleEvents;
use OrderBundle\Form\ConfirmType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OrderController
 * @package OrderBundle\Controller
 */
class OrderController extends Controller
{
    /**
     * Display the product of the order
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $quoteRepository = $this->get('quote.repository');

        /**
         * Get active user order
         */
        $userOrder = $this->get('order.repository')->getActiveUserOrder($user);

        if ($userOrder) {

            $orderProduct = $quoteRepository->getQuoteProduct($userOrder->getId());

            $orderAmount = $quoteRepository->getSumPriceProduct($userOrder->getId());

            return $this->render('@Order/Order/index.html.twig', [
                'products' => $orderProduct,
                'amount' => $orderAmount,
                'order' => $userOrder
            ]);
        }

        return $this->redirectToRoute('catalog_homepage');
    }

    /**
     * Create new Quote product for active User order
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createQuoteAction($id)
    {
        $user = $this->getUser();

        $product = $this->getDoctrine()
            ->getRepository('ProductBundle:Product')
            ->find($id);

        $order = $this->get('order.repository')->createUserOrder($user);

        /**
         * Find active User order and add to order new quote product if active order not
         * found create new User order
         */
        if ($product) {

            $this->get('quote.repository')->addQuote($product, $order);

            $dispatcher = $this->get('event_dispatcher');

            $event = new QuoteEvent($product);

            $dispatcher->dispatch(OrderBundleEvents::QUOTE_CREATED, $event);
        }

        return $this->redirectToRoute('order_homepage');
    }

    /**
     * Delete the product from the order
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteQuoteAction($id)
    {
        $this->get('quote.repository')->deleteQuote($id);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(OrderBundleEvents::QUOTE_DELETE);

        return $this->redirectToRoute('order_homepage');
    }

    /**
     * Confirm active order
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function confirmAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ConfirmType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $phone = $form->getData()->getPhone();

            $sales = $em->getRepository('OrderBundle:Sales')->createOrderSales($id, $phone);

            $dispatcher = $this->get('event_dispatcher');

            $event = new SalesEvent($sales);

            /**
             * Call success Flash Messenger
             */
            $dispatcher->dispatch(OrderBundleEvents::CONFIRM_ORDER, $event);

            return $this->redirectToRoute('catalog_homepage');
        }

        return $this->render('@Order/Order/confirm.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
