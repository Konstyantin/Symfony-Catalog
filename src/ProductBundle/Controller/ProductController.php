<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ProductController
 * @package ProductBundle\Controller
 */
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

        $categories = $em->getRepository('CategoryBundle:Category')->getAllCategory();
        
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
        $em = $this->getDoctrine();

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
        $em = $this->getDoctrine();

        $product = $em->getRepository('ProductBundle:Product')->getOneProduct($name);

        return $this->render('ProductBundle:Product:view.html.twig', ['product' => $product]);
    }
}
