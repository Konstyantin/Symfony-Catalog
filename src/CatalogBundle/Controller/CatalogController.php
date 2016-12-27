<?php

namespace CatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CatalogController
 * @package CatalogBundle\Controller
 */
class CatalogController extends Controller
{
    /**
     * Display product list
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();

        $products = $em->getRepository('ProductBundle:Product')->getLastProduct(6);

        return $this->render('CatalogBundle:Catalog:index.html.twig', ['products' => $products]);
    }
}
