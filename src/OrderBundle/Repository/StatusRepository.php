<?php

namespace OrderBundle\Repository;
use OrderBundle\Entity\Orders;

/**
 * StatusRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StatusRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Set status for select order
     * 
     * @param Orders $orders
     * @param $status
     */
    public function setStatus(Orders $orders, $status)
    {
        $em = $this->getEntityManager();
        
        $status = $em->getRepository('OrderBundle:Status')
            ->findOneBy(['label' => $status]);
        
        $orders->setStatus($status);
        
        $em->persist($orders);
        $em->flush();
    }

    /**
     * Get status id by label
     *
     * @param $label
     * @return mixed
     */
    public function getStatusId($label)
    {
        return $this->createQueryBuilder('s')
            ->select('s.id')
            ->where('s.label = :label')
            ->setParameter('label', $label)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
