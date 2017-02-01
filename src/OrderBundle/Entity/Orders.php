<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="OrderBundle\Repository\OrdersRepository")
 */
class Orders
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="order")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="OrderBundle\Entity\Quote", mappedBy="order")
     */
    protected $quote;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;


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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Orders
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Orders
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quote = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add quote
     *
     * @param \OrderBundle\Entity\Quote $quote
     *
     * @return Orders
     */
    public function addQuote(\OrderBundle\Entity\Quote $quote)
    {
        $this->quote[] = $quote;

        return $this;
    }

    /**
     * Remove quote
     *
     * @param \OrderBundle\Entity\Quote $quote
     */
    public function removeQuote(\OrderBundle\Entity\Quote $quote)
    {
        $this->quote->removeElement($quote);
    }

    /**
     * Get quote
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuote()
    {
        return $this->quote;
    }
}
