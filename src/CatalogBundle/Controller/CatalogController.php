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

        $products = $em->getRepository('ProductBundle:Product')->getAllProduct();

        return $this->render('CatalogBundle:Catalog:index.html.twig', ['products' => $products]);
    }

    /**
     * View one product by $name
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($name)
    {
        $em = $this->getDoctrine();
        
        $product = $em->getRepository('ProductBundle:Product')->getOneProduct($name);

        return $this->render('CatalogBundle:Catalog:view.html.twig', ['product' => $product]);
    }
}
