<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 18.12.16
 * Time: 16:10
 */
namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="OrderBundle\Entity\Orders", mappedBy="user")
     */
    protected $order;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add order
     *
     * @param \OrderBundle\Entity\Orders $order
     *
     * @return User
     */
    public function addOrder(\OrderBundle\Entity\Orders $order)
    {
        $this->order[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \OrderBundle\Entity\Orders $order
     */
    public function removeOrder(\OrderBundle\Entity\Orders $order)
    {
        $this->order->removeElement($order);
    }

    /**
     * Get order
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrder()
    {
        return $this->order;
    }
}
