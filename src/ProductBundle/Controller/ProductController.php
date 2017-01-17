<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package ProductBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * Display all exists products
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $products = $em->getRepository('ProductBundle:Product')->getAllProduct();
        $categories = $em->getRepository('CategoryBundle:Category')->getAllCategory();

        /**
         * @var $pagination \Knp\Component\Pager\Paginator
         */
        $pagination = $this->get('knp_paginator');
        $products = $pagination->paginate(
            $products,
            $request->query->getInt('page', 1),/* page number */
            $request->query->getInt('limit', 2) /* limit per page */
        );

        return $this->render('ProductBundle:Product:list.html.twig', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Get product list by select category
     * 
     * @param $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction($category)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('ProductBundle:Product')
            ->getProductByCategory($category);
        
        return $this->render('ProductBundle:Product:category.html.twig', ['products' => $products]);
    }

    /**
     * View one product by $name
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($name)
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository('ProductBundle:Product')->getOneProduct($name);

        return $this->render('ProductBundle:Product:view.html.twig', ['product' => $product]);
    }
}
