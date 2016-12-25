<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 25.12.16
 * Time: 18:08
 */

namespace Tests\ProductBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductRepositoryTest extends KernelTestCase
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

    public function testGetOneProduct()
    {
        $product = $this->em
            ->getRepository('ProductBundle:Product')
            ->getOneProduct(1);

        $this->assertEquals('Product',$product->getName());
        $this->assertEquals('2000.00',$product->getPrice());
        $this->assertEquals('Product description',$product->getDescription());
        $this->assertEquals('1',$product->getId());
    }
    
    public function testGetAllProduct()
    {
        $products = $this->em
            ->getRepository('ProductBundle:Product')
            ->getAllProduct();
        
        $this->assertNotEmpty($products);
        $this->assertCount(4,$products);
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