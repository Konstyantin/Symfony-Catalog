<?php

namespace ProductBundle\Repository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Get one product by $id
     *
     * @param $name
     * @return array
     */
    public function getOneProduct($name)
    {
        $product = $this->getEntityManager()
            ->getRepository('ProductBundle:Product')
            ->findOneBy(['name' => $name]);

        return $product;
    }

    /**
     * Get all exists products
     *
     * @return array
     */
    public function getAllProduct()
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.id','DESC')
            ->getQuery();
        
        $products = $query->getResult();

        return $products;
    }
}   
