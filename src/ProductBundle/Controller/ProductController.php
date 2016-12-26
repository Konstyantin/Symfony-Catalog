<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * Main product page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('ProductBundle:Product:index.html.twig');
    }

    /**
     * Display all exists products
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine();
        
        $products = $em->getRepository('ProductBundle:Product')->getAllProduct();
        
        return $this->render('ProductBundle:Product:list.html.twig', ['products' => $products]);
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

        return $this->render('ProductBundle:Product:view.html.twig', ['product' => $product]);
    }
}
