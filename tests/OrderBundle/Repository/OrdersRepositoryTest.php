<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 11.02.17
 * Time: 17:49
 */

namespace Tests\OrderBundle\Repository;

use Doctrine\ORM\EntityManager;
use OrderBundle\Entity\Orders;
use OrderBundle\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrdersRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Orders
     */
    private $user;

    /**
     * @var OrdersRepository
     */
    private $orderRepository;

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

        $this->orderRepository = $this->em->getRepository('OrderBundle:Orders');
    }

    public function testCreateUserOrder()
    {
        $order = $this->orderRepository->createUserOrder($this->user);

        $this->assertNotEmpty($order);

        $this->assertObjectHasAttribute('id', $order);
        $this->assertObjectHasAttribute('user', $order);
        $this->assertObjectHasAttribute('status', $order);
        $this->assertObjectHasAttribute('createdAt', $order);

        $this->assertCount(1, [$order]);
    }

    public function testDeleteUserOrder()
    {
        $order = $this->em->getRepository('OrderBundle:Orders')->find(11);

        $this->em->getRepository('OrderBundle:Orders')->deleteUserOrder($this->user, $order);

        $order = $this->orderRepository->find(11);

        $this->assertEmpty($order);
    }

    public function testGetUserOrders()
    {
        $orders = $this->orderRepository->getUserOrders($this->user);

        $this->assertNotEmpty($orders);

        foreach ($orders as $order) {
            $this->assertEquals($order->getUser(), $this->user);
        }
    }

    public function testGetActiveUserOrder()
    {
        $orders = $this->orderRepository->getActiveUserOrder($this->user);

        $active = $this->em->getRepository('OrderBundle:Status')->findOneBy(['label' => 'active']);
        $this->assertNotEmpty($orders);

        foreach ($orders as $order) {
            $this->assertEquals($order->getStatus, $active);
        }
    }

    public function testDeleteOrder()
    {
        $order = $this->orderRepository->find(5);

        $this->orderRepository->deleteOrder($order);

        $res = $this->orderRepository->find(5);

        $this->assertEmpty($res);
    }

    public function testUserOrderList()
    {
        $orders = $this->orderRepository->userOrderList($this->user);

        $this->assertNotEmpty($orders);
    }

    public function testCreateNewOrder()
    {
        $this->orderRepository->createNewOrder($this->user);

        $orders = $this->em->getRepository('OrderBundle:Orders')->findBy(['user' => $this->user]);

        $this->assertNotEmpty($orders);
    }
}