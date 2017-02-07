<?php

namespace OrderBundle\Controller;

use OrderBundle\Entity\Sales;
use OrderBundle\Form\OrderType;
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

        $userOrder = $this->get('order.repository')->getActiveUserOrder($user);

        $orderProduct = $quoteRepository->getQuoteProduct($userOrder->getId());

        $orderAmount = $quoteRepository->getSumPriceProduct($userOrder->getId());

        return $this->render('@Order/Order/index.html.twig', [
            'products' => $orderProduct,
            'amount' => $orderAmount,
            'order' => $userOrder
        ]);
    }

    /**
     * Add a product to order
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createQuoteAction($name)
    {
        $user = $this->getUser();

        $product = $this->getDoctrine()
            ->getRepository('ProductBundle:Product')
            ->getOneProduct($name);
        
        $order = $this->get('order.repository')->createUserOrder($user);

        if ($product) {
            $this->get('quote.repository')->addQuote($product, $order);
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

        $form = $this->createForm(OrderType::class);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $data = $form->getData();
            $phone = $data->getPhone();
            
            $em->getRepository('OrderBundle:Sales')->createOrderSales($id, $phone);

            return $this->redirectToRoute('catalog_homepage');
        }

        return $this->render('@Order/Order/confirm.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
