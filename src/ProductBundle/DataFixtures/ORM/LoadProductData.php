<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 22.12.16
 * Time: 19:43
 */
namespace ProductBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CategoryBundle\Entity\Category;
use ProductBundle\Entity\Product;

/**
 * Class LoadProductData are used to load a set of product data into database,
 * and used for testing or could be initial data required for the application to run smoothly.
 *
 * @package ProductBundle\DataFixtures\ORM
 */
class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Allow you to run creating fixture
     * 
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('category');

        $product = new Product();
        $product->setName('Product');
        $product->setPrice(2000);
        $product->setDescription('Product description');
        $product->addCategory($category);

        $manager->persist($product);
        $manager->flush();
    }

    /**
     * Allowing to set order in which fixtures are loaded
     * 
     * @return int
     */
    public function getOrder()
    {
        return 6;
    }
}