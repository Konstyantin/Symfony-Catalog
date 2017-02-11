<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 11.02.17
 * Time: 14:38
 */

namespace OrderBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OrderBundle\Entity\Quote;

/**
 * Class LoadQuoteData are used to load a set of quote data into database,
 * and used for testing or could be initial data required for the application to run smoothly.
 *
 * @package CategoryBundle\DataFixtures\ORM
 */
class LoadQuoteData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Allow you to run creating fixture
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $product = $manager
            ->getRepository('ProductBundle:Product')
            ->find(1);

        $order = $manager->getRepository('OrderBundle:Orders')->find(1);


        $quote = new Quote();
        $quote->setProduct($product);
        $quote->setOrder($order);
        $quote->setQuantity(1);

        $manager->persist($quote);
        $manager->flush();
    }

    /**
     * Allowing to set order in which fixtures are loaded
     *
     * @return int
     */
    public function getOrder()
    {
        return 123;
    }
}