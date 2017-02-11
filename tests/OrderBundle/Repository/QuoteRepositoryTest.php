<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 11.02.17
 * Time: 19:45
 */

namespace Tests\OrderBundle\Repository;

use Doctrine\ORM\EntityManager;
use OrderBundle\Entity\Quote;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use UserBundle\Entity\User;

class QuoteRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var User
     */
    private $user;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->user = $this->em->getRepository('UserBundle:User')->find(1);
    }

    public function testGetQuoteProduct()
    {
        $order = $this->em->getRepository('OrderBundle:Orders')->find(1)->getId();

        $products = $this->em->getRepository('OrderBundle:Quote')->getQuoteProduct($order);

        $this->assertNotEmpty($products);

        foreach ($products as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('name', $product);
            $this->assertArrayHasKey('price', $product);
            $this->assertArrayHasKey('quantity', $product);
            $this->assertArrayNotHasKey('asd', $product);
        }
    }

    public function testGetSumPriceProduct()
    {
        $order = $this->em->getRepository('OrderBundle:Orders')->find(1);

        $sum = $this->em->getRepository('OrderBundle:Quote')->getSumPriceProduct($order);

        $this->assertNotEmpty($sum);

        $this->assertEquals(8000, $sum);
    }

    public function testAddQuote()
    {
        $product = $this->em->getRepository('ProductBundle:Product')->find(1);
        $order = $this->em->getRepository('OrderBundle:Orders')->find(1);

        $res = $this->em->getRepository('OrderBundle:Quote')->addQuote($product, $order);

        $quote = $this->em->getRepository('OrderBundle:Quote')->findOneBy([
            'order' => $order,
            'product' => $product
        ]);

        $this->assertEquals(3, $quote->getQuantity());
    }

    public function testDeleteQuote()
    {
        $product = $this->em->getRepository('ProductBundle:Product')->find(1);
        $order = $this->em->getRepository('OrderBundle:Orders')->find(1);

        $res = $this->em->getRepository('OrderBundle:Quote')->deleteQuote($product, $order);

        $quote = $this->em->getRepository('OrderBundle:Quote')->findOneBy([
            'order' => $order,
            'product' => $product
        ]);

        $this->assertEquals(2, $quote->getQuantity());
    }

    public function testExistsQuote()
    {
        $product = $this->em->getRepository('ProductBundle:Product')->find(1);
        $order = $this->em->getRepository('OrderBundle:Orders')->find(1);

        $quote = $this->em->getRepository('OrderBundle:Quote')->findOneBy([
            'order' => $order,
            'product' => $product
        ]);

        $this->assertNotEmpty($quote);

        $this->assertObjectHasAttribute('id', $quote);
        $this->assertObjectHasAttribute('order', $quote);
        $this->assertObjectHasAttribute('product', $quote);
        $this->assertObjectHasAttribute('quantity', $quote);
    }

    public function testChangeQuantity()
    {
        $quote = $this->em->getRepository('OrderBundle:Quote')->find(1);

        $this->em->getRepository('OrderBundle:Quote')->changeQuantity($quote, 2);

        $this->assertEquals(2, $quote->getQuantity());
    }
}