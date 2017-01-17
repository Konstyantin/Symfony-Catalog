<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 22.12.16
 * Time: 17:10
 */
namespace CategoryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CategoryBundle\Entity\Category;

/**
 * Class LoadCategoryData are used to load a set of category data into database,
 * and used for testing or could be initial data required for the application to run smoothly.
 *
 * @package CategoryBundle\DataFixtures\ORM
 */
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Allow you to run creating fixture
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $phone = new Category();
        $phone->setName('Category');
        $manager->persist($phone);
        
        $manager->flush();
    }

    /**
     * Allowing to set order in which fixtures are loaded
     *
     * @return int
     */
    public function getOrder()
    {
        return 5;
    }
}