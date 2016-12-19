<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 19.12.16
 * Time: 23:24
 */
namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

/**
 * Class LoadUserData are used to load a set of user data into database,
 * and used for testing or could be initial data required for the application to run smoothly.
 *
 * @package UserBundle\DataFixtures\ORM
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Allow you to run creating fixture
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('kostya');
        $user->setEmail('kostya@mail.com');
        $user->setPassword('$2y$13$LfKbb4tDi7arhgr8Mtk5n.5X2fKUsh6rMZu4lNo6vh0mJNDxn53/S');//123456789q
        $user->setEnabled(1);
        $user->setRoles(['ROLE_USER','ROLE_ADMIN']);

        $manager->persist($user);
        $manager->flush();
    }

    /**
     * allowing to set order in which fixtures are loaded
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}