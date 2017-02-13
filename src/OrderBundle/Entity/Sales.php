<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sales
 *
 * @ORM\Table(name="sales")
 * @ORM\Entity(repositoryClass="OrderBundle\Repository\SalesRepository")
 */
class Sales
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min="10",
     *      max="12",
     *      minMessage="phone length is short",
     *      maxMessage="phone length is long"
     * )
     * @ORM\Column(name="phone", type="bigint")
     */
    protected $phone;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    protected $amount;

    /**
     * @ORM\OneToOne(targetEntity="OrderBundle\Entity\Orders")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $order;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Sales
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Sales
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set order
     *
     * @param \OrderBundle\Entity\Orders $order
     *
     * @return Sales
     */
    public function setOrder(\OrderBundle\Entity\Orders $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \OrderBundle\Entity\Orders
     */
    public function getOrder()
    {
        return $this->order;
    }
}
