<?php

namespace OrderBundle\Repository;

use OrderBundle\Entity\Orders;
use UserBundle\Entity\User;

/**
 * OrdersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrdersRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Create new User order if User don't have an active order
     *
     * @param User $user
     * @return Orders|void
     */
    public function createUserOrder(User $user)
    {
        if ($this->getActiveUserOrder($user)) {
            return $this->getActiveUserOrder($user);
        }
        
        return $this->createNewOrder($user);
    }

    /**
     * Delete order if the order belongs to User
     *
     * @param User $user
     * @param Orders $order
     * @return bool
     */
    public function deleteUserOrder(User $user, Orders $order)
    {
        if ($user === $order->getUser()) {
            $this->deleteOrder($order);
            return true;
        }
        return false;
    }

    /**
     * Get User orders
     *
     * @param $user
     * @return array|\OrderBundle\Entity\Orders[]
     */
    protected function getUserOrders($user)
    {
        return $this->getEntityManager()
            ->getRepository('OrderBundle:Orders')
            ->findBy(['user' => $user]);
    }

    /**
     * Get active User order
     *
     * @param $user
     * @return \OrderBundle\Entity\Orders
     */
    public function getActiveUserOrder($user)
    {
        $status = $this->_em
            ->getRepository('OrderBundle:Status')
            ->getStatusId('active');

        return $this->getEntityManager()
            ->getRepository('OrderBundle:Orders')
            ->findOneBy([
                'user' => $user,
                'status' => $status
            ]);
    }

    /**
     * Create new User order
     *
     * @param $user
     * @return Orders
     */
    protected function createNewOrder($user)
    {
        $em = $this->getEntityManager();

        $order = new Orders();
        $order->setUser($user);

        $status = $em->getRepository('OrderBundle:Status')
            ->setStatus($order, 'active');

        $em->persist($order);
        $em->flush();

        return $order;
    }

    /**
     * Delete order 
     * 
     * @param $order
     */
    protected function deleteOrder($order)
    {
        $em = $this->getEntityManager();
        $em->remove($order);
        $em->flush();
    }

    /**
     * @param User $user
     * @return array|Orders[]
     */
    public function userOrderList(User $user)
    {
        return $this->getEntityManager()
                    ->getRepository('OrderBundle:Orders')
                    ->getUserOrders($user);
    }
}
