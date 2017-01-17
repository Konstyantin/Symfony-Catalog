<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 25.12.16
 * Time: 18:37
 */
namespace Tests\ProductBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use CategoryBundle\Entity\Category;

class CategoryRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testGetAllCategory()
    {
        $category = $this->em
            ->getRepository('CategoryBundle:Category')
            ->getAllCategory();

        $this->assertNotEmpty($category);
        $this->assertCount(5, $category);
    }

    public function testGetCategoryByName()
    {
        $category = $this->em
            ->getRepository('CategoryBundle:Category')
            ->getCategoryByName('Category');

        $this->assertEquals('Category', $category->getName());

        $this->assertNotEmpty($category);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }
}