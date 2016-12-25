<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 25.12.16
 * Time: 18:37
 */
namespace Tests\ProductBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

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
        $this->assertCount(3, $category);
    }
    
    public function testGetCategoryId()
    {
        $category = $this->em
            ->getRepository('CategoryBundle:Category')
            ->getCategoryId('category');
        
        $this->assertEquals(3, $category);
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