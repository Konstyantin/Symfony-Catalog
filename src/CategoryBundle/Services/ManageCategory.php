<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 14.01.17
 * Time: 17:02
 */
namespace CategoryBundle\Services;

use CategoryBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class ManageCategory allow you create and delete category
 * @package CategoryBundle\Services
 */
class ManageCategory
{
    /**
     * @var Category
     */
    protected $category;
    
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ManageCategory constructor.
     * @param Category $category
     * @param EntityManager $entityManager
     */
    public function __construct(Category $category, EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->category = $category;
    }

    /**
     * @param $name
     * 
     * Create new category by pass name
     */
    public function create($name)
    {
        $em = $this->em;
        
        $category = $this->category;
        $category->setName($name);
        
        $em->persist($category);
        $em->flush();
    }

    /**
     * @param $name
     *
     * Delete category by name
     */
    public function delete($name)
    {
        $em = $this->em;

        $category = $em->getRepository('CategoryBundle:Category')
            ->findOneBy(['name' => $name]);

        if (!$category) {
            throw new Exception('Category not found for name ' . $name);
        }

        $em->remove($category);
        $em->flush();
    }
}