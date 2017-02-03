<?php

namespace OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        $orderSum = $quoteRepository->getSumPriceProduct($userOrder->getId());

        return $this->render('@Order/Order/index.html.twig', [
            'products' => $orderProduct,
            'sum' => $orderSum
        ]);
    }

    /**
     * Add a product to order
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addProductAction($name)
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
    public function deleteAction($id)
    {
        $this->get('quote.repository')->deleteQuote($id);

        return $this->redirectToRoute('order_homepage');
    }
}
