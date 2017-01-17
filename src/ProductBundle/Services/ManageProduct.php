<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 15.01.17
 * Time: 8:58
 */
namespace ProductBundle\Services;

use ProductBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class ManageProduct
 * @package ProductBundle\Services
 */
class ManageProduct
{
    /**
     * @var EntityManager
     */
    protected $em;
    /**
     * @var Product
     */
    protected $product;

    /**
     * ManageProduct constructor.
     * @param Product $product
     * @param EntityManager $entityManager
     */
    public function __construct(Product $product, EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->product = $product;
    }

    /**
     * @param $name
     * 
     * Delete product by name
     */
    public function delete($name)
    {
        $em = $this->em;
        
        $product = $em->getRepository('ProductBundle:Product')
            ->getOneProduct($name);

        if (!$product) {
            throw new Exception('Product not found for name ' . $name);
        }

        $em->remove($product);
        $em->flush();
    }
}