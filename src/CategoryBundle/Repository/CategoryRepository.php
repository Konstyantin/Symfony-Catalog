<?php

namespace CategoryBundle\Repository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Get all exists categories
     * 
     * @return array
     */
    public function getAllCategory()
    {
        $query = $this->createQueryBuilder('c')
            ->getQuery();

        $category = $query->getResult();

        return $category;
    }
    
    /**
     * Get category id by set name
     * 
     * @param $name
     * @return int
     */
    public function getCategoryId($name)
    {
        $product = $this->getEntityManager()
            ->getRepository('CategoryBundle:Category')
            ->findOneBy(['name' => $name]);
        
        $product_id = $product->getId();

        return $product_id;
    }
}
