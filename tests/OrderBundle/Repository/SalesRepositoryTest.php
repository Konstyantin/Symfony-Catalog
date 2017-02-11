<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 11.02.17
 * Time: 10:40
 */

namespace Tests\OrderBundle\Repository;

use OrderBundle\Entity\Orders;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SalesRepositoryTest extends KernelTestCase
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

    public function testCreateOrderSales()
    {
        $order = $this->em->getRepository('OrderBundle:Orders')->find(1);

        $orderId = $order->getId();

        $phone = 38066887755;

        $salesRepository = $this->em->getRepository('OrderBundle:Sales');

        $salesRepository->createOrderSales($orderId, $phone);

        $sales = $salesRepository->find(15);

        $this->assertNotEmpty($sales);

        $this->assertObjectHasAttribute('id', $sales);
        $this->assertObjectHasAttribute('phone', $sales);
        $this->assertObjectHasAttribute('amount', $sales);
        $this->assertObjectHasAttribute('order', $sales);

        $this->assertEquals($order, $sales->getOrder());
        $this->assertEquals($phone, $sales->getPhone());
        $this->assertEquals(1, $sales->getOrder()->getId());
    }

    public function testCheckExists()
    {
        $order = $this->em->getRepository('OrderBundle:Orders')->find(1);
        $phone = 38066887755;

        $em = $this->em;

        $sales = $this->em->getRepository('OrderBundle:Sales')->checkExists($order, $phone, $em);

        $this->assertNotEmpty($sales);

        $this->assertObjectHasAttribute('order', $sales);
        $this->assertObjectHasAttribute('phone', $sales);
        $this->assertObjectHasAttribute('amount', $sales);
    }

    public function testSaveSalesOrder()
    {
        $user = $this->em->getRepository('UserBundle:User')->find(1);

        $status = $this->em->getRepository('OrderBundle:Status');

        $phone = 38077665544;
        $order = new Orders();
        $order->setUser($user);
        $status->setStatus($order, 'active');
        $order->setCreatedAt(new \DateTime());

        $userOrder = $this->em->getRepository('OrderBundle:Orders')->getActiveUserOrder($user);

        $orderAmount = $this->em->getRepository('OrderBundle:Quote')->getSumPriceProduct($userOrder->getId());

        $this->em->getRepository('OrderBundle:Sales')->saveSalesOrder($order, $phone, $orderAmount);

        $sales = $this->em->getRepository('OrderBundle:Sales')->find(18);

        $this->assertNotEmpty($sales);
        $this->assertObjectHasAttribute('id', $sales);
        $this->assertObjectHasAttribute('order', $sales);
        $this->assertObjectHasAttribute('phone', $sales);
        $this->assertObjectHasAttribute('amount', $sales);
    }
}