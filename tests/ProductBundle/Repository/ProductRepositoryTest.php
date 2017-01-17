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
            ->getOneProduct('Iphone 7');

        $this->assertEquals('Iphone 7',$product->getName());
        $this->assertEquals('2000.00',$product->getPrice());
    }
    
    public function testGetAllProduct()
    {
        $products = $this->em
            ->getRepository('ProductBundle:Product')
            ->getAllProduct();
        
        $this->assertNotEmpty($products);
        $this->assertCount(4,$products);
    }
    
    public function testGetLastProduct()
    {
        $product = $this->em
            ->getRepository('ProductBundle:Product')
            ->getLastProduct(1);
        
        $this->assertNotEmpty($product);
        $this->assertCount(1,$product);
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