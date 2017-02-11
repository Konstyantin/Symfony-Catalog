<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 11.02.17
 * Time: 14:22
 */

namespace OrderBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OrderBundle\Entity\Orders;

/**
 * Class LoadOrderData are used to load a set of order data into database,
 * and used for testing or could be initial data required for the application to run smoothly.
 *
 * @package CategoryBundle\DataFixtures\ORM
 */
class LoadOrderData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Allow you to run creating fixture
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository('UserBundle:User')->find(1);

        $product = $manager->getRepository('ProductBundle:Product')->find(1);

        $status = $manager->getRepository('OrderBundle:Status');

        $order = new Orders();
        $order->setUser($user);
        $status->setStatus($order, 'active');
        $order->setCreatedAt(new \DateTime());

        $manager->persist($order);
        $manager->flush();
    }

    /**
     * Allowing to set order in which fixtures are loaded
     *
     * @return int
     */
    public function getOrder()
    {
        return 100;
    }
}