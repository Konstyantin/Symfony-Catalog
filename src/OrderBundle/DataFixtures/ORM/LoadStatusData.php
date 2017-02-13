<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 07.02.17
 * Time: 12:31
 */

namespace OrderBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OrderBundle\Entity\Status;

/**
 * Class LoadStatusData are used to load a set of status order data into database,
 * and used for testing or could be initial data required for the application to run smoothly.
 * 
 * @package OrderBundle\DataFixtures\ORM
 */
class LoadStatusData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Allow you to run creating fixture
     * 
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $status = new Status();
        $status->setLabel('active');
        $manager->persist($status);
        
        $status = new Status();
        $status->setLabel('confirm');
        $manager->persist($status);
        
        $status = new Status();
        $status->setLabel('paid');
        $manager->persist($status);
        
        $manager->flush();
    }

    /**
     * Allowing to set order in which fixtures are loaded
     * 
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}