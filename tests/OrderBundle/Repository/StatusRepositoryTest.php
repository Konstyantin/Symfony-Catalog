<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 11.02.17
 * Time: 9:58
 */
namespace Tests\OrderBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StatusRepositoryTest extends KernelTestCase
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

    public function testGetStatusId()
    {
        $em = $this->em->getRepository('OrderBundle:Status');

        $active = $em->getStatusId('active');
        $confirm = $em->getStatusId('confirm');
        $paid = $em->getStatusId('paid');

        $this->assertNotEmpty($active);
        $this->assertNotEmpty($confirm);
        $this->assertNotEmpty($paid);

        $this->assertEquals(1, $active);
        $this->assertEquals(2, $confirm);
        $this->assertEquals(3, $paid);

        $this->assertNotEquals(3, $confirm);
        $this->assertNotEquals(2, $active);
        $this->assertNotEquals(1, $paid);
    }

    public function testSetStatus()
    {
        $status = $this->em->getRepository('OrderBundle:Status');

        $active = $status->findOneBy(['label' => 'active']);
        $confirm = $status->findOneBy(['label' => 'confirm']);
        $paid = $status->findOneBy(['label' => 'paid']);

        $order = $this->em->getRepository('OrderBundle:Orders')->find(1);

        $status->setStatus($order, 'paid');
        $this->assertEquals($paid, $order->getStatus());
        $this->assertNotEquals($confirm, $order->getStatus());

        $status->setStatus($order, 'active');
        $this->assertEquals($active, $order->getStatus());
        $this->assertNotEquals($paid, $order->getStatus());

        $status->setStatus($order, 'confirm');
        $this->assertEquals($confirm, $order->getStatus());
        $this->assertNotEquals($active, $order->getStatus());

    }
}