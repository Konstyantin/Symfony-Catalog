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
     * @param $id
     * @return array
     */
    public function getOneProduct($id)
    {
        $product = $this->getEntityManager()
            ->getRepository('ProductBundle:Product')
            ->findOneBy(['id' => $id]);
        
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
